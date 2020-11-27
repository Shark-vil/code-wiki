/*!
 * Summernote Syntax Highlighting
 * http://epiksel.github.io/summernote-ext-highlight/
 * http://e-piksel.com
 * Original Author: http://www.hyl.pw/
 *
 * Released under the MIT license
 */
(function (factory) {
    /* global define */
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    } else if (typeof module === 'object' && module.exports) {
        // Node/CommonJS
        module.exports = factory(require('jquery'));
    } else {
        // Browser globals: jQuery
        factory(window.jQuery);
    }
}(function ($) {

    // Extends plugins for adding highlight.
    //  - plugin is external module for customizing.
    $.extend($.summernote.plugins, {

        /**
         * @param {Object} context - context object has status of editor.
         */
        'highlight': function (context) {

            var self = this;

            var ui = $.summernote.ui;
            var $editor = context.layoutInfo.editor;
            var options = context.options;
            var lang = options.langInfo;


            // add button

            context.memo('button.highlight', function () {
                // create button
                var button = ui.button({
                    contents: '<i class="note-icon-code"></i>',
                    tooltip: lang.highlight.desc,
                    click: function () {
                        self.show()
                    }
                });

                // create jQuery object from button instance.
                var $highlight = button.render();
                return $highlight;
            });

            this.createDialog = function () {

                var $box = $('<div />');
                var $selectGroup = $('<div class="form-group" />');
                var $textGroup = $('<div class="form-group" />');
                var $select = $('<select class="form-control ext-highlight-select" />');
                var $custom = $('<input class="form-control ext-highlight-custom" />');

                var languages = [
                    'lua', 'css', 'htm', 'html', 'php', 'java', 'js', 'xml', 'sql', 'py', 'rb',
                    'apoll', 'basic', 'clj', 'coffee', 'dart', 'erlan', 'go', 'hs',
                    'lasso', 'lisp', 'llvm', 'logta', 'matla', 'ml', 'mumps', 'n',
                    'pasca', 'perl', 'proto', 'r', 'rd', 'rust', 'scala', 'swift',
                    'tcl', 'tex', 'vb', 'vhdl', 'wiki', 'xhtml', 'xq', 'yaml'
                ];

                for (var i = 0; i < languages.length; i++) {
                    $select.append('<option value="' + languages[i] + '">' + languages[i] + '</option>');
                }

                var $label = $('<label />');
                $label.html(lang.highlight.select);
                $box.append($selectGroup.append($label));
                $box.append($selectGroup.append($select));

                $label = $('<br><label />');
                $label.html(lang.highlight.custom);
                $box.append($selectGroup.append($label));
                $box.append($selectGroup.append($custom));

                var $label = $('<label />');
                $label.html(lang.highlight.codeFragment);
                var $textarea = $('<textarea class="ext-highlight-code form-control" rows="8" />');

                $box.append($textGroup.append($label));
                $box.append($textGroup.append($textarea));

                return $box.html();
            };

            this.createCodeNode = function (code, select, custom) {
                var $code = $('<code>');
                $code.html(code.replace(/</g,"&lt;").replace(/>/g,"&gt;"));
                if (custom != null && custom.length != 0)
                    $code.addClass('language-' + custom);
                else
                    $code.addClass('language-' + select);
                $code.addClass('hljs');

                var $p = $('<p>');
                var $pre = $('<pre>');
                $pre.html($code)
                $p.html($pre)

                return $p[0];
            };

            this.showHighlightDialog = function (codeInfo) {
                return $.Deferred(function (deferred) {
                    var $extHighlightCode = self.$dialog.find('.ext-highlight-code');
                    var $extHighlightBtn = self.$dialog.find('.ext-highlight-btn');
                    var $extHighlightSelect = self.$dialog.find('.ext-highlight-select');
                    var $extHighlightCustom = self.$dialog.find('.ext-highlight-custom');

                    ui.onDialogShown(self.$dialog, function () {
                        context.triggerEvent('dialog.shown');

                        $extHighlightCode.val(codeInfo);

                        $extHighlightCode.on('input', function () {
                            ui.toggleBtn($extHighlightBtn, $extHighlightCode.val() != '');

                            codeInfo = $extHighlightCode.val();
                        });

                        $extHighlightBtn.one('click', function (event) {
                            event.preventDefault();
                            context.invoke('editor.restoreRange');
                            context.invoke('editor.focus');
                            context.invoke('editor.insertNode', self.createCodeNode(codeInfo, $extHighlightSelect.val(), $extHighlightCustom.val()));
                            context.invoke('editor.insertNode', $('<p>')[0]);

                            self.$dialog.modal('hide');
                        });
                    });

                    ui.onDialogHidden(self.$dialog, function () {
                        context.triggerEvent('dialog.shown');
                        deferred.resolve();
                    });
                    ui.showDialog(self.$dialog);
                }).promise();
            };

            this.getCodeInfo = function () {
                var text = context.invoke('editor.getSelectedText');
                return '';
            };

            this.show = function () {
                var codeInfo = self.getCodeInfo();

                context.invoke('editor.saveRange');
                this.showHighlightDialog(codeInfo).then(function (codeInfo) {
                    context.invoke('editor.restoreRange');
                });
            };

            //// This events will be attached when editor is initialized.
            //this.event = {
            //    // This will be called after modules are initialized.
            //    'summernote.init': function (we, e) {
            //        console.log('summernote initialized', we, e);
            //    },
            //    // This will be called when user releases a key on editable.
            //    'summernote.keyup': function (we, e) {
            //        console.log('summernote keyup', we, e);
            //    }
            //};
            //
            //// This method will be called when editor is initialized by $('..').summernote();
            //// You can create elements for plugin
            this.initialize = function () {
                var $container = options.dialogsInBody ? $(document.body) : $editor;

                var body = [
                    '<button href="#" class="btn btn-primary ext-highlight-btn disabled" disabled>',
                    lang.highlight.insertCode,
                    '</button>'
                ].join('');

                this.$dialog = ui.dialog({
                    className: 'ext-highlight',
                    title: lang.highlight.insertCode,
                    body: this.createDialog(),
                    footer: body,
                    //callback: function ($node) {
                    //    $node.find('.modal-body').css({
                    //        'max-height': 300,
                    //        'overflow': 'scroll'
                    //    });
                    //}
                }).render().appendTo($container);
            };

            // This methods will be called when editor is destroyed by $('..').summernote('destroy');
            // You should remove elements on `initialize`.
            this.destroy = function () {
                ui.hideDialog(this.$dialog);
                this.$dialog.remove();
            };
        }
    });
}));
