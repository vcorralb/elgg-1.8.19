/**
 *  Test for the Drag & Drop function.
 *  As Most of the functionallity of Drop event handler should be implemented
 *  by private/inner functions it can't be tested here.
 */

(function(win, doc) {


TestCase("Init Test", {
    setUp: function() {},
    tearDown: function() {},

    "test if data is uninitialized at the beginning": function () {
        assertNull(oForm);
        assertUndefined(fpDragEnter);
        assertUndefined(fpDragLeave);
        assertUndefined(fpCancel);
        assertUndefined(fpDrop);
        assertUndefined(fpReaderLoad);
    }
});

TestCase("Function Test", {
    setUp: function() {
        /*:DOC oForm=<form class=".elgg-form-avatar-upload"></form> */
    },
    tearDown: function() {},

    "test if function callbacks are initialized": function () {
        assertFunction(fpDragEnter);
        assertFunction(fpDragLeave);
        assertFunction(fpCancel);
        assertFunction(fpDrop);
    },
    "test if callbacks cancel event propagation": function () {
        var e = window.Event;
        assertFalse(fpDragEnter(e));
        assertFalse(fpDragLeave(e));
        assertFalse(fpCancel(e));
        assertFalse(fpDrop(e));
    },
    "test if HTML DIV is correctly inserted and has the handlers assigned": function () {
        var oDiv = oForm.querySelector(".dropfile-init");
        assertNotNull(oDiv);
        assert(oDiv.innerHTML === "");
        assertFunction(oDiv.dragenter);
        assertFunction(oDiv.dragleave);
        assertFunction(oDiv.ondrop);
        assertFunction(oDiv.ondragover);
        assertFunction(oDiv.ondragEnd);
    },
    "test if visual changes are implemented by CSS": function () {
        var oDiv = oForm.querySelector(".dropfile-init"),
            sClasses = oDiv.className,
            e = win.Event,
            sClasses2;

        fpDragEnter.call(oDiv, e);
        assert(sClasses !== oDiv.className);

        sClasses2 = oDiv.className;
        fpDragLeave.call(oDiv, e);
        assert(sClasses2 !== oDiv.className);
        assert(sClasses === oDiv.className);
    }
});

TestCase("Drop functionallity", {
    setUp: function() {
        /*:DOC oForm=<form class=".elgg-form-avatar-upload"></form> */
        this.e = win.Event;
        e.dataTransfer = {
            files: [];
        };
        e.dataTransfer.files.push({type: "image/png"});
    },
    tearDown: function() {
        this.e = null;
    },
    "test if data is uninitialized at the beginning": function () {
        assertObject(reader);

    }
});

}(document));