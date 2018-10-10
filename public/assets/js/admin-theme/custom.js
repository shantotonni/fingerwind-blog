/**
 * Created by mithun on 8/17/17.
 */

function loadEditor(id){
        CKEDITOR.focusManager._.blurDelay = 10;

        var instance = CKEDITOR.instances[id];
        if(instance){
            //CKEDITOR.destroy(instance);
        }
        var editor = CKEDITOR.replace( id, {
                 customConfig: "config/basic/config.js",
                 filebrowserBrowseUrl: "kcfinder/browse.php?type=files",
                 filebrowserImageBrowseUrl: "kcfinder/browse.php?type=images",
                 filebrowserFlashBrowseUrl: "kcfinder/browse.php?type=flash",
                 filebrowserUploadUrl: "kcfinder/upload.php?type=files",
                 filebrowserImageUploadUrl: "kcfinder/upload.php?type=images",
                 filebrowserFlashUploadUrl: "kcfinder/upload.php?type=flash"
            });

        editor.on("blur",function(){
            CKupdate();
        })
    }

    function CKupdate(){
        for ( instance in CKEDITOR.instances )
            CKEDITOR.instances[instance].updateElement();
    }

