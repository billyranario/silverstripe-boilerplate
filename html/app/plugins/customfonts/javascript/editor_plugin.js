tinymce.init({
    content_css: ['../css/fonts.css'],  // Adjust the path as needed
});

tinymce.PluginManager.add("customfonts", function (editor, url) {
    let menuButtonApi = null;
    const items = [
        // {type: "choiceitem", text: "Amasis MT Pro Regular", value: "amasis-mt-pro-regular"},
        // {type: "choiceitem", text: "Amasis MT Pro Light", value: "amasis-mt-pro-light"},
        {type: "choiceitem", text: "Angsana New", value: "angsana-new"},
        {type: "choiceitem", text: "Aparajita", value: "aparajita"},
        {type: "choiceitem", text: "Aptos Serif", value: "aptos-serif"},
        {type: "choiceitem", text: "Mr Gabe Regular", value: "mr-gabe-regular"},
        // {type: "choiceitem", text: "Chamberi Super Display Regular", value: "chamberi-super-display-regular"},
        {type: "choiceitem", text: "Times New Roman", value: "times-new-roman"},
        {type: "choiceitem", text: "Walbaum Display", value: "walbaum-display"},
    ];

    editor.ui.registry.addMenuButton("customfonts", {
        text: "Custom Fonts",
        fetch: function (callback) {
            callback(items.map(function (item) {
                return {
                    type: "togglemenuitem",
                    text: item.text,
                    onAction: function () {
                        let customFormatName = "customfont_" + item.value;
                        if (!editor.formatter.has(customFormatName)) {
                            editor.formatter.register(customFormatName, {
                                inline: "span",
                                classes: item.value,
                            });
                        }
                        editor.formatter.toggle(customFormatName);
                    },
                    onSetup: function (api) {
                        function updateState() {
                            let isActive = false;
                            for (let item of items) {
                                let customFormatName = "customfont_" + item.value;
                                if (editor.formatter.match(customFormatName, {}, editor.selection.getNode())) {
                                    api.setActive(true);
                                    isActive = true;
                                    if (menuButtonApi) {
                                        menuButtonApi.setText(item.text);
                                    }
                                    break;
                                }
                            }
                            if (!isActive) {
                                api.setActive(false);
                                if (menuButtonApi) {
                                    menuButtonApi.setText("Custom Fonts");
                                }
                            }
                        }
                        editor.on('NodeChange FormatChange', updateState);
                        return function () {
                            editor.off('NodeChange FormatChange', updateState);
                        };
                    }
                };
            }));
        },
        // onSetup: function (api) {
        //     menuButtonApi = api;
        //     return function () {
        //         menuButtonApi = null;
        //     };
        // }
    });
});
