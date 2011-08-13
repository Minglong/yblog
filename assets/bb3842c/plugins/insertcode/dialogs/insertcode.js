CKEDITOR.dialog.add('insertcode',function(editor)
{
  var escape = function(value)
  {
    return value.replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/\"/g, '&quot;')
            .replace(/\'/g, '&#39;'); 
  };
  return
  {
    title: 'Insert Code Dialog',
    resizable: CKEDITOR.DIALOG_RESIZE_BOTH,
    minWidth: 420,
    minHeight: 350,
    contents: [{
            id: 'cb',
            name: 'cb',
            label: 'cb',
            title: 'cb',
            elements: 
            [{
                type: 'select',
                label: 'Language',
                id: 'lang',
                required: true,
                'default': 'php',
                items: [['C#', 'csharp'], 
['C++', 'cpp'], ['CSS', 'css'],
['Delphi', 'delphi'], ['Html', 'xhtml'],
['JavaScript', 'js'], ['Java', 'java'],
['Perl', 'perl'], ['PHP', 'php'], ['Python', 'py'],
['Ruby', 'rails'], ['SQL', 'sql'],
['Visual Basic', 'vb'], ['XML', 'xml']]
             },
             {
                type: 'textarea',
                style: 'width:400px;height:330px',
                label: 'Code',
                id: 'code',
                rows: 20,
                'default': ''
             }]
        }],
    onOk: function()
    {
      code = this.getValueOf('cb', 'code');
      lang = this.getValueOf('cb', 'lang'); 
      html = '' + escape(code) + '';
      var i = 0;
      var tmp = '';
      while (html.indexOf('\n') != -1)
      {
        var tclass = 'prettyprint';
        var tnode = i % 2 ? 'nocode' : 'nocode1';
        ++i;
        tmp += '<li class=\"' 
+ tnode + '\"><pre class=\"'+tclass+' lang='+lang+'\">';
        tmp += html.substring(0,
 html.indexOf('\n')+1);
        html = html.substr(html.indexOf('\n')+1);
        tmp += "</pre></li>";
      }
      tnode = i % 2 ? 'nocode' : 'nocode1';
      tmp += "<li class=\"" 
+ tnode + "\"><pre class=\""
+tclass+' lang='+lang+'\">'+html+"</pre></li>";
      editor.insertHtml("<ol class=\"olcode\">" 
+ tmp + "</ol>");
    },
    onLoad: function(){}
  };
});
