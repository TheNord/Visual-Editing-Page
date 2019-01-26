<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWidgetContactFormExample extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('widgets', function (Blueprint $table) {
            DB::table('widgets')->insert([
                'name' => 'Форма обратной связи',
                'template' => '
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form method="POST" action="{{ route("mail.send") }}">
                    @csrf
                   <div class="form-group">
                       <label for="email">Ваш email</label>
                       <input type="email" class="form-control" id="email" placeholder="Введите ваш email" name="email">
                  </div>
                  <div class="form-group">
                      <label for="name">Ваше имя</label>
                      <input type="text" class="form-control" id="name" placeholder="Введите ваше имя" name="name">
                  </div>
                  <div class="form-group">
                      <label for="text">Текст сообщения</label>
                      <textarea class="form-control" id="text" name="text" rows="10"></textarea>
                  </div>
                  <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="check" name="check">
                      <label class="form-check-label" for="check" name="check">Согласен на обработку персональных данных</label>
                  </div>
                  <br />
                      <button type="submit" class="btn btn-primary">Отправить</button>
                  </form>
                '
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('widgets', function (Blueprint $table) {
            //
        });
    }
}
