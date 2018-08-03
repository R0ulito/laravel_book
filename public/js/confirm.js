(function () {

    $('.deleteButton').on('click', function() {
        $(this).parent('form').submit();
    })
    $('.delete').on('submit', function(){
        return confirm('Voulez-vous supprimer ce livre ?')
    })
})()