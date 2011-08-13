CKEDITOR.plugins.add('insertcode',   
 {    
    requires: ['dialog'],
    init:function(a)
    { 
      var b="insertcode";
      var c=a.addCommand(b,
new CKEDITOR.dialogCommand(b));
      a.ui.addButton("insertcode", {
         label:a.lang.toolbar,
command:b,icon:this.path+"images/insertcode.png"
         }
        );
      CKEDITOR.dialog.add(b,
this.path+"dialogs/insertcode.js")}
}
);
