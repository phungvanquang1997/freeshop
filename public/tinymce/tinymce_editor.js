var editor_config = {
    path_absolute : '',
	language : 'en',
    // selector: "textarea",
    theme: "modern",
    plugins: [
    "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak",
    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media facebookembed nonbreaking",
    "table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern"
    ],
    toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
    toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
    toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | visualchars visualblocks nonbreaking template pagebreak restoredraft",
    image_advtab: false,
    //toolbar_items_size: 'small',
    image_class_list: [
        {title: 'None', value: ''},
        {title: 'Image Responsive', value: 'img-responsive'}
    ],
      content_css: [        
        '//www.tinymce.com/css/codepen.min.css'
      ],    
    file_browser_callback : function(field_name, url, type, win) { 
                // from http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript
                var w = window,
                d = document,
                e = d.documentElement,
                g = d.getElementsByTagName('body')[0],
                x = w.innerWidth || e.clientWidth || g.clientWidth,
                y = w.innerHeight|| e.clientHeight|| g.clientHeight;
            // Url absolute
            // var cmsURL = 'http://localhost/filemanager/show?&field_name='+field_name+'&lang='+tinymce.settings.language;
            // var cmsURL = 'http://localhost/otherfolder/filemanager/show?&field_name='+field_name+'&lang='+tinymce.settings.language;
            var cmsURL = editor_config.path_absolute+'filemanager/show?&field_name='+field_name+'&lang='+tinymce.settings.language;

            if(type == 'image') {           
                cmsURL = cmsURL + "&type=images";
            }

            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no"
            });         

        }
};