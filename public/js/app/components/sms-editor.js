export default function testComponent({state, refs}) {
    return {
        state,

        refs,

        init() {
        },

        addVariable(data) {
            this.insertTextAtCursor(this.refs.smsEditor, '{'+data+'}');
            //this.refs.smsEditor
            //this.state = this.state+ '{'+data+'}';
        },

        insertTextAtCursor(el, text) {
            let val = el.value, endIndex, range;
            if (typeof el.selectionStart != "undefined" && typeof el.selectionEnd != "undefined") {
                endIndex = el.selectionEnd;
                el.value = val.slice(0, el.selectionStart) + text + val.slice(endIndex);
                el.selectionStart = el.selectionEnd = endIndex + text.length;
            } else if (typeof document.selection != "undefined" && typeof document.selection.createRange != "undefined") {
                el.focus();
                range = document.selection.createRange();
                range.collapse(false);
                range.text = text;
                range.select();
            }
        }




    }
}
