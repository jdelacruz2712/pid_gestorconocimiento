<?php
    session_start();
    $seconds = 0;
    sleep($seconds);
    if(empty($_SESSION['id_user_apl'])){
?>
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title">Su sesión ha culminado</h3>
        </div>
        <div class="modal-body">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title">No te encuentras logeado</h3>
                </div>
                <div class="panel-body text-center">
                  La sesión ya ha culminado por el cual no podras visualizar nada en la plataforma, 
                  favor de actualizar la web para poder ingresar nuevamente o darle click al siguiente boton : <a data-dismiss="modal" class="btn btn-warning cierre_modal">Actualizar</a>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <a data-dismiss="modal" class="btn btn-default cierre_modal">Cerrar</a>
        </div>
    </div>
<?php
    }else{
    $_SESSION['filemanager_categoria'] = "borrador";
?>    
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title">Insertar Borrador</h3>
        </div>
        <div class="modal-body">
            <form id="insert_borrador" class="sky-form">
                <fieldset>
                    <div class="row">
                        <section class="col col-12">
                            <label>Titulo Borrador</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-tint"></i></span>
                                <input name="txt_borrador" type="text" class="txt_borrador form-control" id="inputTiBorrador" placeholder="Titulo del Borrador">
                                <input name="id_autor" type="text" value="<?= $_SESSION['id_user_apl'] ?>" hidden>
                                <input name="ip_autor" type="text" value="<?= $_SERVER['REMOTE_ADDR'] ?>" hidden>
                                <input name="fec_creacion" type="text" value="<?= date("Y-m-d") ?>" hidden>
                            </div>
                        </section>
                    </div>
                    <div class="row">
                        <section class="col col-12">
                            <textarea name="contenido" class="insertar_borrador form-control">
                                <p style="text-align: center;"><strong>Descripci&oacute;n del Escenario:</strong></p>
                                <p style="text-align: center;">Describir de forma detallada el escenario que se reporta.</p>
                                <p style="text-align: center;">&nbsp;</p>
                                <p style="text-align: center;"><strong>Captura de Pantalla:</strong></p>
                                <p style="text-align: center;">Adjunta la captura de pantalla correspondiente evidenciando el inconveniente, como tambien el correo original y el número de caso.</p>
                                <p style="text-align: center;">&nbsp;</p>
                                <p style="text-align: center;"><strong>Acci&oacute;n Correctiva:</strong></p>
                                <p style="text-align: center;">Detallar el procedimiento a seguir para solucionar y/o canalizar correctamente la incidencia.</p>
                            </textarea>
                        </section>
                    </div>
                    <div class="row modal-footer">
                        <a data-dismiss="modal" class="btn btn-default">Cerrar</a>
                        <input class="btn btn-primary" type="submit" value="Agregar">
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
<script>
    $('textarea.insertar_borrador').tinymce({
        extended_valid_elements: "table[class=table table-bordered table-striped],ul[class=custom-bullet],img[class=img-responsive center-block|!src|border:0|alt|title|width|height|style]",
        theme: "modern",
        height: 300,
        font_formats: "Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace;AkrutiKndPadmini=Akpdmi-n",
        fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern imagetools responsivefilemanager"
        ],
        toolbar1: "responsivefilemanager undo redo | formatselect styleselect fontsizeselect | forecolor backcolor | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link unlink anchor | image table | print preview media | emoticons ",
        style_formats: [
            {title: 'Open Sans', inline: 'span', styles: { 'font-family':'Open Sans'}},
            {title: 'Arial', inline: 'span', styles: { 'font-family':'arial'}},
            {title: 'Book Antiqua', inline: 'span', styles: { 'font-family':'book antiqua'}},
            {title: 'Comic Sans MS', inline: 'span', styles: { 'font-family':'comic sans ms,sans-serif'}},
            {title: 'Courier New', inline: 'span', styles: { 'font-family':'courier new,courier'}},
            {title: 'Georgia', inline: 'span', styles: { 'font-family':'georgia,palatino'}},
            {title: 'Helvetica', inline: 'span', styles: { 'font-family':'helvetica'}},
            {title: 'Impact', inline: 'span', styles: { 'font-family':'impact,chicago'}},
            {title: 'Symbol', inline: 'span', styles: { 'font-family':'symbol'}},
            {title: 'Tahoma', inline: 'span', styles: { 'font-family':'tahoma'}},
            {title: 'Terminal', inline: 'span', styles: { 'font-family':'terminal,monaco'}},
            {title: 'Times New Roman', inline: 'span', styles: { 'font-family':'times new roman,times'}},
            {title: 'Verdana', inline: 'span', styles: { 'font-family':'Verdana'}}
        ],
        menubar: false,
        fullscreen_new_window : true,
        toolbar_items_size: 'small',
        image_advtab: true,
        fix_list_elements : true,
        external_filemanager_path:"assets/js/tinymce/filemanager/",
        filemanager_title:"Gestor de Archivos - PID - CLARO AN" ,
        external_plugins: { "filemanager" : "filemanager/plugin.min.js"}
    });    
    
    $('#insert_borrador').submit(function( event ) {
        if ($(".txt_borrador").val() == '') {
            swal({
                title: "",
                text: "Favor de completar los campos",
                type: "warning",
                showCancelButton: false,
                showConfirmButton: true
            });
            return false;
            }else{
                var datos = $(this).serialize();
                swal({
                    title: 'Deseas agregar esta borrador?',
                    text: "Recuerda haber llenado todo correctamente !",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#1b9cdd',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '<i class="fa fa-plus"></i> Agregar',
                    showLoaderOnConfirm: false,
                    cancelButtonText: '<i class="fa fa-times"></i> Cancelar'
                }).then(function() {
                    $.ajax({
                        type: "POST",
                        url: "ajax/action_class/insert/insert_borrador.php",
                        data: datos,
                        success: function(data) {
                            if(data == "true"){
                                setTimeout(function(){     
                                    swal({
                                        title: "",
                                        text: "Se agrego el borrador con exito",
                                        type: "success",
                                        showCancelButton: false,
                                        showConfirmButton: true
                                    }).then(function() {
                                        setTimeout(function(){
                                            $(document.body).css('padding-right','');
                                        },200);
                                    });
                                    $('#modal_ins_borrador').modal('toggle');
                                }, 600);
                            }else{
                                swal({
                                    title: "",
                                    text: "Error al insertar el borrador, informalo al administrador y/o desarrollador",
                                    type: "error",
                                    showCancelButton: false,
                                    showConfirmButton: true
                                });
                            }
                        }
                    });
                }, function(dismiss) {
                  if (dismiss === 'cancel') {
                    swal({
                        title: "",
                        text: "No se agrego nada al borrador",
                        type: "error",
                        showCancelButton: false,
                        showConfirmButton: true
                    });
                  }
                });
            }
        event.preventDefault();
    });
</script>
<?php } ?>
<script>
    $(".cierre_modal").click(function(){
       window.location.reload(true); 
    });
</script>