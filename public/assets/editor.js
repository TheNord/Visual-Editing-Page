window.addEventListener('load', function() {
    let editor;
    editor = ContentTools.EditorApp.get();

    ContentTools.IMAGE_UPLOADER = imageUploader;

    editor.init('[data-editable], [data-fixture]', 'data-name');
    editor.start();
    editor.ignition().state('editing');

    editor.addEventListener('saved', function (ev) {
        let regions;

        // Check that something changed
        regions = ev.detail().regions;

        if (Object.keys(regions).length == 0) {
            return;
        }

        // Set the editor as busy while we save our changes
        this.busy(true);

        // Send the update content to the server to be saved
        function onStateChange(ev) {
            // Check if the request is finished
                editor.busy(false);
                if (ev.status == '200') {
                    // Save was successful, notify the user with a flash
                    new ContentTools.FlashUI('ok');
                } else {
                    // Save failed, notify the user with a flash
                    new ContentTools.FlashUI('no');
                }
        }

        axios
            .post(`/admin/interactive/${page}/save`, {body: regions})
            .then(res => onStateChange(res))
            .catch(error => console.log(error));
    });


});

function imageUploader(dialog) {
    let image, xhr, xhrComplete, xhrProgress;

    // Set up the event handlers
    dialog.addEventListener('imageuploader.cancelupload', function () {
        // Cancel the current upload

        // Stop the upload
        if (xhr) {
            xhr.upload.removeEventListener('progress', xhrProgress);
            xhr.removeEventListener('readystatechange', xhrComplete);
            xhr.abort();
        }

        // Set the dialog to empty
        dialog.state('empty');
    });

    dialog.addEventListener('imageuploader.clear', function () {
        // Clear the current image
        dialog.clear();
        image = null;
    });

    dialog.addEventListener('imageuploader.fileready', function (ev) {

        // Upload a file to the server
        let formData;
        let file = ev.detail().file;

        // Define functions to handle upload progress and completion
        xhrProgress = function (ev) {
            // Set the progress for the upload
            dialog.progress((ev.loaded / ev.total) * 100);
        };

        xhrComplete = function (ev) {
            // Check the request is complete
            if (ev.request.readyState != 4) {
                return;
            }

            // Clear the request
            xhr = null
            xhrProgress = null
            xhrComplete = null

            // Handle the result of the upload
            if (parseInt(ev.request.status) == 200) {
                // Store the image details
                image = {
                    size: ev.data.size,
                    url: ev.data.url
                };

                window.img = image;

                // Populate the dialog
                dialog.populate(image.url, image.size);

            } else {
                // The request failed, notify the user
                new ContentTools.FlashUI('no');
            }
        };

        // Set the dialog state to uploading and reset the progress bar to 0
        dialog.state('uploading');
        dialog.progress(0);

        // Build the form data to post to the server
        formData = new FormData();
        formData.append('file', file);

        axios
            .post('/admin/ajax/upload/imagePage', formData)
            .then(res => {
                xhrProgress(res);
                xhrComplete(res)
            })
            .catch(error => console.log(error))
    });

    dialog.addEventListener('imageuploader.save', function () {
        let crop, cropRegion, formData;

        // Clear the request
        xhr = null
        xhrComplete = null

        // Free the dialog from its busy state
        dialog.busy(false);

        // Trigger the save event against the dialog with details of the
        // image to be inserted.
        dialog.save(
            img.url,
            img.size,
            {
                'data-ce-max-width': img.size[0]
            });
    });

}