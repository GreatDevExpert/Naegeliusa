jQuery(function ($) {
	/*date picker*/
	$('#id_startdate, .add-on').datepicker({'autoclose':true});
	/*time picker*/
    $('#id_starttime').timepicker({defaultTime: false});
    /*add field*/
    var rowNum = 0;
    $('#addfield').on('click', function(){
    	rowNum++;
    	$( "#maybeadd" ).append( '<div class="col-md-4 col-xs-12" data-outer-parent="true"><label class="control-label" for="depname">DEPONENT NAME(S)</label><div class="input-group"><input name="depname[]" class="form-control" id="id_depname'+rowNum+'" type="text"><span class="input-group-addon deletefield" id="deletefield'+rowNum+'"><i class="glyphicon glyphicon-minus"></i></span></div></div>' );
    });
    /*delete field*/
    for (var i = 1; i <= 30; i++) {
    	$("#maybeadd").on("click", "#deletefield"+i, function(){
	    	$(this).parents('[data-outer-parent="true"]:first').remove();
	    });
    };
    
    /*function validateMail(mail) {
        var pattern = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{2,3}$/;
        //var pattern = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
        if (pattern.test(mail)) {
            return true;
        }     
        return false;
    }
    if(mail == "" || !(validateMail(mail))) {
        $('#mailid').addClass('error');
        error = 0;
    }*/

});