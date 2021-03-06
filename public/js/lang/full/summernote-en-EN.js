!(function (e, t) {
    if ("object" == typeof exports && "object" == typeof module) module.exports = t();
    else if ("function" == typeof define && define.amd) define([], t);
    else {
        var r = t();
        for (var o in r) ("object" == typeof exports ? exports : e)[o] = r[o];
    }
})(window, function () {
    return (function (e) {
        var t = {};
        function r(o) {
            if (t[o]) return t[o].exports;
            var n = (t[o] = { i: o, l: !1, exports: {} });
            return e[o].call(n.exports, n, n.exports, r), (n.l = !0), n.exports;
        }
        return (
            (r.m = e),
            (r.c = t),
            (r.d = function (e, t, o) {
                r.o(e, t) || Object.defineProperty(e, t, { enumerable: !0, get: o });
            }),
            (r.r = function (e) {
                "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, { value: "Module" }), Object.defineProperty(e, "__esModule", { value: !0 });
            }),
            (r.t = function (e, t) {
                if ((1 & t && (e = r(e)), 8 & t)) return e;
                if (4 & t && "object" == typeof e && e && e.__esModule) return e;
                var o = Object.create(null);
                if ((r.r(o), Object.defineProperty(o, "default", { enumerable: !0, value: e }), 2 & t && "string" != typeof e))
                    for (var n in e)
                        r.d(
                            o,
                            n,
                            function (t) {
                                return e[t];
                            }.bind(null, n)
                        );
                return o;
            }),
            (r.n = function (e) {
                var t =
                    e && e.__esModule
                        ? function () {
                              return e.default;
                          }
                        : function () {
                              return e;
                          };
                return r.d(t, "a", t), t;
            }),
            (r.o = function (e, t) {
                return Object.prototype.hasOwnProperty.call(e, t);
            }),
            (r.p = ""),
            r((r.s = 37))
        );
    })({
        37: function (e, t) {
            var r;
            (r = jQuery).extend(r.summernote.lang, {
                "en-EN": {
                    highlight: { desc: "Program code", select: "Choose language", custom: "Custom language", codeFragment: "Paste the code snippet", insertCode: "Insert code" },
                    font: {
                        bold: "Bold",
                        italic: "Italics",
                        underline: "Underlined",
                        clear: "Remove font styles",
                        height: "Line height",
                        name: "Font",
                        strikethrough: "Strikethrough",
                        subscript: "Subscript",
                        superscript: "Superscript",
                        size: "Font size",
                    },
                    image: {
                        image: "Picture",
                        insert: "Insert picture",
                        resizeFull: "Restore size",
                        resizeHalf: "Reduce to 50%",
                        resizeQuarter: "Reduce to 25%",
                        floatLeft: "Position to the left",
                        floatRight: "Arrange to the right",
                        floatNone: "Default location",
                        shapeRounded: "Shape: Rounded",
                        shapeCircle: "Shape: Circle",
                        shapeThumbnail: "Shape: Miniature",
                        shapeNone: "Shape: None",
                        dragImageHere: "Drag a picture here",
                        dropImage: "Drag the picture",
                        selectFromFiles: "Select from files",
                        maximumFileSize: "Maximum file size",
                        maximumFileSizeError: "Maximum file size exceeded",
                        url: "Image URL",
                        remove: "Delete picture",
                        original: "Original",
                    },
                    video: { video: "Video", videoLink: "Link to video", insert: "Insert video", url: "Video URL", providers: "(YouTube, Vimeo, Vine, Instagram, DailyMotion or Youku)" },
                    link: { link: "Link", insert: "Insert link", unlink: "Remove link", edit: "Edit", textToDisplay: "Displayed text", url: "URL to go", openInNewWindow: "Open in a new window" },
                    table: {
                        table: "Table",
                        addRowAbove: "Add row above",
                        addRowBelow: "Add row below",
                        addColLeft: "Add column to the left",
                        addColRight: "Add column to the right",
                        delRow: "Delete line",
                        delCol: "Delete column",
                        delTable: "Delete table",
                    },
                    hr: { insert: "Insert horizontal line" },
                    style: { style: "Style", p: "Normal", blockquote: "Quote", pre: "Code", h1: "Heading 1", h2: "Heading 2", h3: "Heading 3", h4: "Heading 4", h5: "Heading 5", h6: "Heading 6" },
                    lists: { unordered: "Bulleted list", ordered: "Numbered list" },
                    options: { help: "Help", fullscreen: "In full screen", codeview: "Source" },
                    paragraph: {
                        paragraph: "Paragraph",
                        outdent: "Decrease indent",
                        indent: "Increase indent",
                        left: "Align left",
                        center: "Align center",
                        right: "Align right",
                        justify: "Stretch to width",
                    },
                    color: {
                        recent: "Last color",
                        more: "More colors",
                        background: "Background color",
                        foreground: "Font color",
                        transparent: "Transparent",
                        setTransparent: "Make transparent",
                        reset: "Reset",
                        resetToDefault: "Reset to default",
                    },
                    shortcut: {
                        shortcuts: "Keyboard shortcuts",
                        close: "Close",
                        textFormatting: "Text formatting",
                        action: "Action",
                        paragraphFormatting: "Paragraph formatting",
                        documentStyle: "Document style",
                        extraKeys: "Additional combinations",
                    },
                    help: {
                        insertParagraph: "New paragraph",
                        undo: "Undo the last command",
                        redo: "Redo last command",
                        tab: "Tab",
                        untab: "Untab",
                        bold: 'Set the style to "Bold"',
                        italic: 'Set the style to "Italic"',
                        underline: 'Set the style to "Underline"',
                        strikethrough: 'Set the style to "Strikethrough"',
                        removeFormat: "Reset styles",
                        justifyLeft: "Align Left",
                        justifyCenter: "Align Center",
                        justifyRight: "Align Right",
                        justifyFull: "Stretch to full width",
                        insertUnorderedList: "Enable / disable bulleted list",
                        insertOrderedList: "Enable / disable numbered list",
                        outdent: "Remove indentation in the current paragraph",
                        indent: "Insert indentation in the current paragraph",
                        formatPara: "Format the current block as a paragraph (P tag)",
                        formatH1: "Format the current block as H1",
                        formatH2: "Format the current block as H2",
                        formatH3: "Format the current block as H3",
                        formatH4: "Format the current block as H4",
                        formatH5: "Format the current block as H5",
                        formatH6: "Format the current block as H6",
                        insertHorizontalRule: "Insert horizontal line",
                        "linkDialog.show": 'Show dialogue "Link"',
                    },
                    history: { undo: "Undo", redo: "Redo" },
                    specialChar: { specialChar: "SPECIAL CHARACTERS", select: "Select Special characters" },
                },
            });
        },
    });
});
