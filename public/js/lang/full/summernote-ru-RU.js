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
                "ru-RU": {
                    highlight: { desc: "Программный код", select: "Выберите язык", custom: "Произвольный язык", codeFragment: "Вставьте фрагмент кода", insertCode: "Вставить код" },
                    font: {
                        bold: "Полужирный",
                        italic: "Курсив",
                        underline: "Подчёркнутый",
                        clear: "Убрать стили шрифта",
                        height: "Высота линии",
                        name: "Шрифт",
                        strikethrough: "Зачёркнутый",
                        subscript: "Нижний индекс",
                        superscript: "Верхний индекс",
                        size: "Размер шрифта",
                    },
                    image: {
                        image: "Картинка",
                        insert: "Вставить картинку",
                        resizeFull: "Восстановить размер",
                        resizeHalf: "Уменьшить до 50%",
                        resizeQuarter: "Уменьшить до 25%",
                        floatLeft: "Расположить слева",
                        floatRight: "Расположить справа",
                        floatNone: "Расположение по-умолчанию",
                        shapeRounded: "Форма: Закругленная",
                        shapeCircle: "Форма: Круг",
                        shapeThumbnail: "Форма: Миниатюра",
                        shapeNone: "Форма: Нет",
                        dragImageHere: "Перетащите сюда картинку",
                        dropImage: "Перетащите картинку",
                        selectFromFiles: "Выбрать из файлов",
                        maximumFileSize: "Максимальный размер файла",
                        maximumFileSizeError: "Превышен максимальный размер файла",
                        url: "URL картинки",
                        remove: "Удалить картинку",
                        original: "Оригинал",
                    },
                    video: { video: "Видео", videoLink: "Ссылка на видео", insert: "Вставить видео", url: "URL видео", providers: "(YouTube, Vimeo, Vine, Instagram, DailyMotion или Youku)" },
                    link: { link: "Ссылка", insert: "Вставить ссылку", unlink: "Убрать ссылку", edit: "Редактировать", textToDisplay: "Отображаемый текст", url: "URL для перехода", openInNewWindow: "Открывать в новом окне" },
                    table: {
                        table: "Таблица",
                        addRowAbove: "Добавить строку выше",
                        addRowBelow: "Добавить строку ниже",
                        addColLeft: "Добавить столбец слева",
                        addColRight: "Добавить столбец справа",
                        delRow: "Удалить строку",
                        delCol: "Удалить столбец",
                        delTable: "Удалить таблицу",
                    },
                    hr: { insert: "Вставить горизонтальную линию" },
                    style: { style: "Стиль", p: "Нормальный", blockquote: "Цитата", pre: "Код", h1: "Заголовок 1", h2: "Заголовок 2", h3: "Заголовок 3", h4: "Заголовок 4", h5: "Заголовок 5", h6: "Заголовок 6" },
                    lists: { unordered: "Маркированный список", ordered: "Нумерованный список" },
                    options: { help: "Помощь", fullscreen: "На весь экран", codeview: "Исходный код" },
                    paragraph: {
                        paragraph: "Параграф",
                        outdent: "Уменьшить отступ",
                        indent: "Увеличить отступ",
                        left: "Выровнять по левому краю",
                        center: "Выровнять по центру",
                        right: "Выровнять по правому краю",
                        justify: "Растянуть по ширине",
                    },
                    color: {
                        recent: "Последний цвет",
                        more: "Еще цвета",
                        background: "Цвет фона",
                        foreground: "Цвет шрифта",
                        transparent: "Прозрачный",
                        setTransparent: "Сделать прозрачным",
                        reset: "Сброс",
                        resetToDefault: "Сбросить по умолчанию",
                    },
                    shortcut: {
                        shortcuts: "Сочетания клавиш",
                        close: "Закрыть",
                        textFormatting: "Форматирование текста",
                        action: "Действие",
                        paragraphFormatting: "Форматирование параграфа",
                        documentStyle: "Стиль документа",
                        extraKeys: "Дополнительные комбинации",
                    },
                    help: {
                        insertParagraph: "Новый параграф",
                        undo: "Отменить последнюю команду",
                        redo: "Повторить последнюю команду",
                        tab: "Tab",
                        untab: "Untab",
                        bold: 'Установить стиль "Жирный"',
                        italic: 'Установить стиль "Наклонный"',
                        underline: 'Установить стиль "Подчеркнутый"',
                        strikethrough: 'Установить стиль "Зачеркнутый"',
                        removeFormat: "Сбросить стили",
                        justifyLeft: "Выровнять по левому краю",
                        justifyCenter: "Выровнять по центру",
                        justifyRight: "Выровнять по правому краю",
                        justifyFull: "Растянуть на всю ширину",
                        insertUnorderedList: "Включить/отключить маркированный список",
                        insertOrderedList: "Включить/отключить нумерованный список",
                        outdent: "Убрать отступ в текущем параграфе",
                        indent: "Вставить отступ в текущем параграфе",
                        formatPara: "Форматировать текущий блок как параграф (тег P)",
                        formatH1: "Форматировать текущий блок как H1",
                        formatH2: "Форматировать текущий блок как H2",
                        formatH3: "Форматировать текущий блок как H3",
                        formatH4: "Форматировать текущий блок как H4",
                        formatH5: "Форматировать текущий блок как H5",
                        formatH6: "Форматировать текущий блок как H6",
                        insertHorizontalRule: "Вставить горизонтальную черту",
                        "linkDialog.show": 'Показать диалог "Ссылка"',
                    },
                    history: { undo: "Отменить", redo: "Повтор" },
                    specialChar: { specialChar: "СПЕЦИАЛЬНЫЕ СИМВОЛЫ", select: "Выберите специальные символы" },
                },
            });
        },
    });
});
