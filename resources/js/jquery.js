try {
    window.$ = window.jQuery = require('jquery');
    
    global.CellsHelper = class CellsHelperClass {
        constructor(obj) {
            if (obj.tagName !== "TR")
                obj = obj.closest('tr');

            this.row = obj;
        }

        getValue(id) {
            return this.row.cells[id].innerHTML
        }

        getRow() {
            return this.row;
        }
    }
} catch (e) {
    if (!isProduction)
        console.error('Failed to load "jQuery" module.');
}