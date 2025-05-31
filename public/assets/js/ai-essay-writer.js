const sampleText = "Twinkle Twinkle Little Star";
(() => {
    $(document).ready(() => {
        console.log("run");
        $("#input-topic-name").on("change, input", handleInput);
        $("#js-sample-text").on("click", handleSampleText);
    });

    // handle sample text
    const handleSampleText = () => {
        const $targetElem = $("#input-topic-name");
        $targetElem.val(sampleText);
    };

    // handle input
    const handleInput = () => {};
})();
