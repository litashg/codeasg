(function () {
var hr = (function () {
  'use strict';

  var PluginManager = tinymce.util.Tools.resolve('tinymce.PluginManager');

  var register = function (editor) {
    editor.addCommand('InsertHorizontalRule', function () {
      editor.execCommand('mceInsertContent', false, '<hr />');
    });
  };
  var $_5g275dbsjducwqy9 = { register: register };

  var register$1 = function (editor) {
    editor.addButton('hr', {
      icon: 'hr',
      tooltip: 'Horizontal line',
      cmd: 'InsertHorizontalRule'
    });
    editor.addMenuItem('hr', {
      icon: 'hr',
      text: 'Horizontal line',
      cmd: 'InsertHorizontalRule',
      context: 'insert'
    });
  };
  var $_3ns4m2btjducwqya = { register: register$1 };

  PluginManager.add('hr', function (editor) {
    $_5g275dbsjducwqy9.register(editor);
    $_3ns4m2btjducwqya.register(editor);
  });
  function Plugin () {
  }

  return Plugin;

}());
})();
