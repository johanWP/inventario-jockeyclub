<script>
$( document ).ready(function()
{
    var sectors;

    $.ajax({
        url: "/api/getSectors/",
        type: "GET",
        dataType : "json",
    })
        .done(function( json ) {
            sectors = json;
        })
        .fail(function( xhr, status, errorThrown ) {
            alert( "Sorry, there was a problem!" );
            console.log( "Error: " + errorThrown );
            console.log( "Status: " + status );
            console.dir( xhr );
        })
        .always(function( xhr, status ) {
//            console.log( "The request is complete!" );
        });

    $('#sector_id').change(function()
    {
        var selectedSector = sectors[$(this).val()];
        $('#area_id').empty().append('<option value= "">Seleccione...</option>');
        $.each(selectedSector, function (name, area) {
            $('#area_id').append('<option value=' + area.id + '>' + area.name + '</option>');
        });
    });

});  // Fin del Document.ready
</script>