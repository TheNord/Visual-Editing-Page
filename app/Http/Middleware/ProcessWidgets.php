<?php

namespace App\Http\Middleware;

use Closure;
use App\Entity\Widget;

class ProcessWidgets
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $this->processWidgets($request, $response);

        return $response;
    }

    /**
     * Find and replace widgets page.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Http\Response $response
     * @return mixed
     */
    protected function processWidgets($request, $response): void
    {
        // получаем контент
        $content = $response->getContent();

        // ищем в контенте шортокод виджета: [TPart=1], где 1 id виджета в базе данных
        // и заменяем виджетром из базы
        $content = preg_replace_callback('/\[TPart=(\d+)\]/', function ($partials) {
            // сохраняем ид виджета
            $widgetId = $partials[1];
            // записываем путь для сохранения виджета
            $path = resource_path() . "/views/widgets/widget-$widgetId.blade.php";

            // если файл уже существует просто возвращаем его
            if (!file_exists($path)) {
                // если не существует находим виджет по ид в бд
                $result = Widget::find($widgetId);

                if(!$result) {
                    file_put_contents($path, 'Widget not found');
                } else {
                    // создаем файл в папке views/widgets под ид виджета
                    file_put_contents($path, $result->template);
                }
            }

            // проводим полученный файл через шаблонизатор
            // (дает возможность использовать блэйд в виджтеха)
            return view('widgets.widget-' . $widgetId);
        }, $content);

        // возвращаем контент
        $response->setContent($content);
    }

}
