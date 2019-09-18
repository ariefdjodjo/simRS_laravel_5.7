
    @foreach($usulan as $data)
        <option value="{{$data->id_usulan}}">{{$data->no_usulan}}</option>
    @endforeach

    <script type='text/javascript'>
    
    $('#tahun').selectize({
        create: false,
        sortField: 'text'
    });

    $('#tahun').change(function(){
        var id = $('#tahun').val();

        // Empty the dropdown
        $('#noUsulan').find('option').not(':first').remove();
        
        $.ajax({
            url: 'loadUsulan/'+id,
            type: 'get',
            dataType: 'json',
            success: function(usulan){

                var len = 0;
                if(usulan['data'] != null){
                len = usulan['data'].length;
                }

                if(len > 0){
                // Read data and create <option >
                for(var i=0; i<len; i++){

                    var id = usulan['data'][i].id_usulan;
                    var name = usulan['data'][i].no_usulan;

                    var option = "<option value='"+id+"'>"+name+"</option>"; 

                    $("#noUsulan").append(option); 
                }
                }

            }
        });
});

   
</script>

$.ajax({
       url: 'loadUsulan/'+id,
       dataType: 'json',
       success: function(response){

         var len = 0;
         if(response['data'] != null){
           len = response['data'].length;
         }

         if(len > 0){
           // Read data and create <option >
           for(var i=0; i<len; i++){

             var id = response['data'][i].id_usulan;
             var name = response['data'][i].no_usulan;

             var option = "<option value='"+id+"'>"+name+"</option>"; 

             $("#noUsulan").append(option); 
           }
         } 
       }
      });


      $.ajax({
        
        })