import { loadScript } from "./general.js";

(() => {
    $(document).ready(() => {
        //download
        $("#download").on("click", handleDownloadResume);
        //delete functions
        $(document).on(
            "click",
            "#js-delete-skill, #js-delete-hobby, #js-delete-award, .js-delete-work-exp, .js-delete-education",
            handleDelete
        );

        // add more
        $(document).on("click", "#js-add-work-exp", handleAddMoreWokExperience);
        $(document).on("click", "#js-add-educ-more", handleAddMoreEducation);

        // company name
        $(document).on("input change paste", ".js-company-name", function () {
            const $value = $(this).val().trim();
            const $dataId = $(this).data("id");
            if (!$dataId) {
                if ($value !== "") {
                    $("#company-name").text($value + " " + "|");
                } else {
                    $("#company-name").text("|");
                }
            } else {
                if ($value !== "") {
                    $(`#company-name-${$dataId}`).text($value + " " + "|");
                } else {
                    $(`#company-name-${$dataId}`).text("|");
                }
            }
        });

        // job-start-date
        $(document).on("input change paste", ".js-job-start-date", function () {
            const $value = $(this).val().trim();
            const $dataId = $(this).data("id");
            if (!$dataId) {
                if ($value !== "") {
                    $("#job-start-date").text($value + "-");
                } else {
                    $("#job-start-date").text("-");
                }
            } else {
                if ($value !== "") {
                    $(`#job-start-date-${$dataId}`).text($value + "-");
                } else {
                    $(`#job-start-date-${$dataId}`).text("-");
                }
            }
        });

        // job-end-date
        $(document).on("input change paste", ".js-job-end-date", function () {
            const $value = $(this).val().trim();
            const $dataId = $(this).data("id");
            if (!$dataId) {
                if ($value !== "") {
                    $("#job-end-date").text($value);
                } else {
                    $("#job-end-date").text("");
                }
            } else {
                if ($value !== "") {
                    $(`#job-end-date-${$dataId}`).text($value);
                } else {
                    $(`#job-end-date-${$dataId}`).text("");
                }
            }
        });

        // company position
        $(document).on(
            "input change paste",
            ".js-company-position",
            function () {
                const $value = $(this).val().trim();
                const $dataId = $(this).data("id");
                if (!$dataId) {
                    if ($value !== "") {
                        $("#company-designation").text($value);
                    } else {
                        $("#company-designation").text("");
                    }
                } else {
                    if ($value !== "") {
                        $(`#company-designation-${$dataId}`).text($value);
                    } else {
                        $(`#company-designation-${$dataId}`).text("");
                    }
                }
            }
        );

        // js-job-summarry
        $(document).on("input change paste", ".js-job-summarry", function () {
            const $value = $(this).val().trim();
            const $dataId = $(this).data("id");
            if (!$dataId) {
                if ($value !== "") {
                    $("#role-description").text($value);
                } else {
                    $("#role-description").text("");
                }
            } else {
                if ($value !== "") {
                    $(`#role-description-${$dataId}`).text($value);
                } else {
                    $(`#role-description-${$dataId}`).text("");
                }
            }
        });

        $("#js-full-name").on("input change paste", function () {
            const full_name = $(this).val().trim().slice(0, 30);
            if (full_name !== "") {
                $("#name").text(full_name);
            } else {
                $("#name").text("");
            }
        });

        // position name
        $("#js-position-name").on("input change paste", function () {
            const position_name = $(this).val().trim().slice(0, 50);
            if (position_name !== "") {
                $("#designation").text(position_name);
            } else {
                $("#designation").text("");
            }
        });

        // summary
        $("#js-summarry").on("input change paste", function () {
            const summary_text = $(this).val().trim();
            if (summary_text !== "") {
                $("#cv-summary").text(summary_text);
            } else {
                $("#cv-summary").text("");
            }
        });

        // email
        $("#email").on("input change paste", function () {
            const email = $(this).val().trim();
            if (email !== "") {
                $("#email-result").text(email + "|");
            } else {
                $("#email-result").text("");
            }
        });

        // mobile number
        $("#mobile-number").on("input change paste", function () {
            const mobile_number = $(this).val().trim();
            if (mobile_number !== "") {
                $("#phone-no-result").text(`${mobile_number} |`);
            } else {
                $("#phone-no-result").text("|");
            }
        });

        // city
        $("#address-result").on("input change paste", function () {
            const $value = $(this).val().trim();
            if ($value !== "") {
                $("#address-result").text(`${$value} `);
            } else {
                $("#address-result").text(" ");
            }
        });

        // skills add
        $("#skill-name").on("keyup", function (e) {
            const skill_name = $(this).val().trim();

            if (skill_name !== "") {
                if (e.key === "Enter" || e.keyCode === 13) {
                    const uniq_id = generateUniqueString(6);
                    $(this).val("");

                    // Remove initial demo/template skills if present
                    const $ul = $("#js-append-skills");
                    if ($ul.data("template-removed") !== true) {
                        $ul.empty();
                        $ul.data("template-removed", true);
                    }

                    const $html = `
                      <div id="${uniq_id}" class="bg-white w-max py-1.5 px-2 uppercase text-sm/4 font-normal rounded flex gap-2 items-center js-parent-elem">
                          ${skill_name} |
                          <button data-id="${uniq_id}" type="button" id="js-delete-skill" class="leading-0 cursor-pointer">
                            ❌
                          </button>
                      </div>
                    `;
                    const $appendSKillsInCv = `
                    <li class="text-sm/5 text-gray-600 font-normal js-parent-elem uppercase" id="${uniq_id}">${skill_name}</li>
                    `;
                    $("#js-added-skills").append($html);
                    $ul.append($appendSKillsInCv);
                }
            }
        });

        // hobbies add
        $("#hobby-name").on("keyup", function (e) {
            const hobby_name = $(this).val().trim();

            if (hobby_name !== "") {
                if (e.key === "Enter" || e.keyCode === 13) {
                    const uniq_id = generateUniqueString(6);
                    $(this).val("");

                    // Remove initial demo/template skills if present
                    const $ul = $("#js-append-hobbies");
                    if ($ul.data("template-removed") !== true) {
                        $ul.empty();
                        $ul.data("template-removed", true);
                    }

                    const $html = `
                      <div id="${uniq_id}" class="bg-white w-max py-1.5 px-2 uppercase text-sm/4 font-normal rounded flex gap-2 items-center js-parent-elem">
                          ${hobby_name} |
                          <button data-id="${uniq_id}" type="button" id="js-delete-hobby" class="leading-0 cursor-pointer">
                            ❌
                          </button>
                      </div>
                    `;
                    const $appendHobbiesInCv = `
                    <li class="text-sm/5 text-gray-600 font-normal js-parent-elem uppercase" id="${uniq_id}">${hobby_name}</li>
                    `;
                    $("#js-added-hobbies").append($html);
                    $ul.append($appendHobbiesInCv);
                }
            }
        });

        // awards name
        $("#award-name").on("keyup", function (e) {
            const award = $(this).val().trim();

            if (award !== "") {
                if (e.key === "Enter" || e.keyCode === 13) {
                    const uniq_id = generateUniqueString(6);
                    $(this).val("");

                    // Remove initial demo/template skills if present
                    const $ul = $("#js-append-awards");
                    if ($ul.data("template-removed") !== true) {
                        $ul.empty();
                        $ul.data("template-removed", true);
                    }

                    const $html = `
                      <div id="${uniq_id}" class="bg-white w-max py-1.5 px-2 uppercase text-sm/4 font-normal rounded flex gap-2 items-center js-parent-elem">
                          ${award} |
                          <button data-id="${uniq_id}" type="button" id="js-delete-award" class="leading-0 cursor-pointer">
                            ❌
                          </button>
                      </div>
                    `;
                    const $appendAwardsInCv = `
                    <li class="text-sm/5 text-gray-600 font-normal js-parent-elem uppercase" id="${uniq_id}">${award}</li>
                    `;
                    $("#js-added-awards").append($html);
                    $ul.append($appendAwardsInCv);
                }
            }
        });

        // degree name
        $("#js-degree-name").on("change input paste", function () {
            const $value = $(this).val().trim();

            if ($value) {
                $("#degree-name").text($value);
            } else {
                $("#degree-name").text("");
            }
        });

        // degree start date
        $("#js-degree-start-date").on("change input paste", function () {
            const $value = $(this).val().trim();

            if ($value) {
                $("#degree-start-date").text(`(${$value} -`);
            } else {
                $("#degree-start-date").text("( -");
            }
        });

        // degree end date
        $("#js-degree-end-date").on("change input paste", function () {
            const $value = $(this).val().trim();

            if ($value) {
                $("#degree-end-date").text(`${$value})`);
            } else {
                $("#degree-end-date").text(")");
            }
        });
    });
})();

// handle delete data
const handleDelete = (e) => {
    const data_id = $(e.currentTarget).data("id");
    $(`.js-parent-elem#${data_id}`).remove();
};

// generate uniq id
const generateUniqueString = (length = 12) =>
    `${Date.now().toString(36)}-${Math.random()
        .toString(36)
        .substr(2, length)}`;

const handleAddMoreWokExperience = () => {
    const unique_id = generateUniqueString(5);
    const $html = `
    <div class="flex flex-col gap-2 w-full js-parent-elem" id="${unique_id}">
      <div class="flex gap-2 items-center w-full">
        <h3 class="text-white text-3xl font-semibold flex-1"></h3>
        <button type="button" data-id="${unique_id}"
          class="w-[28px] js-delete-work-exp h-[28px] text-sm/4 text-white hover:text-black cursor-pointer hover:bg-gray-100 rounded-full transition-all ease-in duration-100">
          ❌
        </button>
      </div>
      <div class="flex items-center gap-1.5 w-full">
        <input type="text" placeholder="Company Name" data-id="${unique_id}"
          class="border-gray-300 rounded js-company-name text-gray-50 py-2 px-3 ring-0 focus:border-gray-400 outline-0 border w-full" value="Enzipe">
        <input type="text" placeholder="Position" data-id="${unique_id}"
          class="border-gray-300 rounded js-company-position text-gray-50 py-2 px-3 ring-0 focus:border-gray-400 outline-0 border w-full" value="Frontend Developer">
      </div>
      <div class="flex items-center gap-1.5 w-full">
        <input type="name" placeholder="Start Date" data-id="${unique_id}"
          class="border-gray-300 rounded js-job-start-date text-gray-50 py-2 px-3 ring-0 focus:border-gray-400 outline-0 border w-full" value="18-03-2025">
        <input type="name" placeholder="End Date" data-id="${unique_id}"
          class="border-gray-300 rounded js-job-end-date text-gray-50 py-2 px-3 ring-0 focus:border-gray-400 outline-0 border w-full" value="Present">
      </div>
      <textarea name="job-summary" cols="20" rows="6" placeholder="Job Summary" data-id="${unique_id}"
        class="border-gray-300 rounded js-job-summarry text-gray-50 py-2 px-3 ring-0 focus:border-gray-400 outline-0 border w-full resize-none overflow-y-auto">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ullam, odit laborum sequi non iste autem aspernatur aut fugiat voluptatibus neque asperiores doloribus atque ratione saepe! Iure fugiat assumenda
      </textarea>
    </div>
  `;
    const workAppend = `
    <div class="flex flex-col gap-3 w-full js-parent-elem" id="${unique_id}">
      <div class="flex justify-between gap-3 w-full">
        <div class="flex items-center gap-1 flex-1">
          <h3 id="company-name-${unique_id}" class="text-xl/6 font-medium text-gray-600">Enzipe |</h3>
          <h4 id="company-designation-${unique_id}" class="text-xl/6 font-medium text-gray-600">Frontend Developer</h4>
        </div>
        <div class="job-start-date flex items-center gap-1">
          <p id="job-start-date-${unique_id}" class="text-sm/6 font-medium text-gray-600">18-03-2025 -</p>
          <p id="job-end-date-${unique_id}" class="text-sm/6 font-medium text-gray-600">Present</p>
        </div>
      </div>
      <p id="role-description-${unique_id}" class="text-gray-600 font-normal text-sm/5">
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ullam, odit laborum sequi non iste autem
        aspernatur aut fugiat voluptatibus neque asperiores doloribus atque ratione saepe! Iure fugiat
        assumenda
        facilis unde.
      </p>
    </div>
    `;
    $("#js-work-experience").append($html);
    $("#js-append-work-experience").append(workAppend);
};

const handleAddMoreEducation = () => {
    const unique_id = generateUniqueString(5);
    const $html = `
    <div class="flex flex-col gap-2 mt-3 js-parent-elem w-full" id="${unique_id}">
      <div class="flex gap-2 items-center w-full">
        <h3 class="text-white text-3xl font-semibold flex-1"></h3>
        <button type="button" data-id="${unique_id}"
          class="w-[28px] h-[28px] js-delete-education text-white hover:text-black text-sm/4 cursor-pointer hover:bg-gray-100 rounded-full transition-all ease-in duration-100">
          ❌
        </button>
      </div>
      <input type="text" placeholder="Degree Name" id="js-degree-name"
        class="border-gray-300 rounded text-gray-50 py-2 px-3 ring-0 focus:border-gray-400 outline-0 border w-full">
      <div class="flex items-center gap-1.5 w-full">
        <input type="name" placeholder="Start Date" id="js-degree-start-date"
          class="border-gray-300 rounded text-gray-50 py-2 px-3 ring-0 focus:border-gray-400 outline-0 border w-full">
        <input type="name" placeholder="End Date" id="degree-end-date"
          class="border-gray-300 rounded text-gray-50 py-2 px-3 ring-0 focus:border-gray-400 outline-0 border w-full">
      </div>
    </div>
    `;
    $("#js-education-append-more").append($html);
};

// download resume
const handleDownloadResume = async () => {
    try {
        await loadScript("html2pdfjs");

        const originalContent = document.getElementById("resume-content");
        if (!originalContent) {
            alert("Resume content not found!");
            return;
        }

        // Create a simplified clone for PDF generation
        const content = originalContent.cloneNode(true);
        content.style.width = "210mm"; // A4 width
        document.body.appendChild(content);

        // Remove problematic Tailwind classes
        const classesToRemove = [
            "bg-opacity-",
            "text-opacity-",
            "border-opacity-",
            "from-",
            "via-",
            "to-",
            "bg-gradient-",
            "shadow-",
            "backdrop-",
        ];

        content.querySelectorAll("[class]").forEach((el) => {
            const classes = el.className.split(" ");
            const filtered = classes.filter(
                (cls) =>
                    !classesToRemove.some((prefix) => cls.startsWith(prefix))
            );
            el.className = filtered.join(" ");
        });

        // Convert modern color formats to RGB/HEX
        content.querySelectorAll("*").forEach((el) => {
            const style = window.getComputedStyle(el);
            ["color", "backgroundColor", "borderColor"].forEach((prop) => {
                if (
                    style[prop].includes("oklch") ||
                    style[prop].includes("var(--tw")
                ) {
                    el.style[prop] = "#000000"; // Fallback color
                }
            });
        });

        const opt = {
            margin: 0,
            filename: "my-resume.pdf",
            image: { type: "jpeg", quality: 1.1 },
            html2canvas: {
                scale: 2,
                logging: true,
                useCORS: true,
                scrollY: 0, // Important for capturing full height
                ignoreElements: (el) => {
                    // Skip elements with complex styling
                    return (
                        el.classList.contains("loader") ||
                        el.classList.contains("tooltip")
                    );
                },
            },
            jsPDF: {
                unit: "in",
                format: "a4",
                orientation: "portrait",
                hotfixes: ["px_scaling"], // Improves rendering quality
                putOnlyUsedFonts: true, // Reduces file size
            },
            pagebreak: {
                mode: ["css", "avoid-all"], // Better page break handling
            },
        };

        await html2pdf().set(opt).from(content).save();
        document.body.removeChild(content);
    } catch (error) {
        console.error("PDF generation failed:", error);
        alert("Failed to generate PDF. Please try with simpler content first.");
    }
};
