tpl = {
  templates : {},
  
  loadTemplates : function(names, callback) {
    var self = this;
    
    var loadTemplate = function(index) {
      var name = names[index];
      $.get('../template/useradmin/' + name + '.mustache', function(data) {
        self.templates[name] = data;
        index++;
        if (index < names.length) {
          loadTemplate(index);
        } else {
          callback();
        }
      });
    };
    loadTemplate(0);
  },
  
  get : function(name) {
    var that = this.templates;
    if (name in that) {
      return that[name];
    } else {
      $.ajax({url:'../template/useradmin/' + name + '.mustache',
                  success: function(data) {
                    that[name] = data;
                    return that[name];
                  },
                  async: false
      });
      return that[name];
    }
  }
};