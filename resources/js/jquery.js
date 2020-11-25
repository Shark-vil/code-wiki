var isProduction = (process.env.NODE_ENV === "production")

try {
    window.$ = window.jQuery = require('jquery');
    
    global.CellsHelper = class CellsHelperClass {
        constructor(obj) {
            if (obj.tagName !== "TR")
                obj = obj.closest('tr');

            this.rows = obj;
        }

        getValue(id) {
            return this.rows.cells[id].innerHTML
        }
    }
     
    $(document).ready(function(){
        if (!isProduction)
            console.log('Module "jQuery" was loaded successfully.');
    });
} catch (e) {
    if (!isProduction)
        console.assert('Failed to load "jQuery" module.');
}