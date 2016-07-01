{!! Html::script('assets/backend/plugins/ckeditor/ckeditor.js') !!}
        <!-- Bootstrap WYSIHTML5 -->
{!! Html::script('assets/backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') !!}
<script type="text/javascript">
    $(function() {
        $("[data-mask]").inputmask();
        $('textarea.ckeditor').each(function(){
            CKEDITOR.replace( $(this).attr('id'), {
                extraPlugins: 'oembed,image2,justify,widget',
                //config.image2_alignClasses = [ 'align-left', 'align-center', 'align-right' ];
                image2_captionedClass: 'image-captioned',
                on: {
                    dialogShow: function ( evt ) {
                        var dialog = evt.data;
                        if (  dialog.getName() == 'image2') {
                            dialog.setValueOf( 'info', 'align', 'center' );
                            dialog.setValueOf( 'info', 'width', '600' );

                            dialog.setValueOf( 'info', 'hasCaption', 'checked' );
                        }
                    }
                }
            } );
            CKEDITOR.config.allowedContent = true;


            $.fn.modal.Constructor.prototype.enforceFocus = function() {
                modal_this = this
                $(document).on('focusin.modal', function (e) {
                    if (modal_this.$element[0] !== e.target && !modal_this.$element.has(e.target).length
                            && !$(e.target.parentNode).hasClass('cke_dialog_ui_input_select')
                            && !$(e.target.parentNode).hasClass('cke_dialog_ui_input_text')) {
                        modal_this.$element.focus()
                    }
                })
            };

        });

    });
</script>