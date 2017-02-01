<script>
$( document ).ready(function()
{
    var areas;

    $.ajax({
        url: "/api/getAreas/",
        type: "GET",
        dataType : "json"
    })
        .done(function( json ) {
            areas = json;
        })
        .fail(function( xhr, status, errorThrown ) {
            alert( "Hubo un error al cargar el listado de áreas." );
            console.log( "Error: " + errorThrown );
            console.log( "Status: " + status );
            console.dir(xhr);
        })
        .always(function( xhr, status ) {
//            console.log( "The request is complete!" );
        });

    $('#area_id').change(function()
    {
        var selectedArea = areas[$(this).val()];
        $('#sector_id').empty().append('<option value= "">Seleccione...</option>');
        $.each(selectedArea, function (name, sector) {
            $('#sector_id').append('<option value=' + sector.id + '>' + sector.name + '</option>');
        });
    });

});  // Fin del Document.ready
</script>