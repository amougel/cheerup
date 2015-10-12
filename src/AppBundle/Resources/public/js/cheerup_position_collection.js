$(document).ready(function () {
    var $collectionContainer = $('.collection_container');
    $collectionContainer.manageCollection();
    $collectionContainer.on('text.before-delete', function(event) {
        this.beforeDelete(event);
    }.bind(this));
});
