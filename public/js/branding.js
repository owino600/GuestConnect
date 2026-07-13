document.addEventListener("DOMContentLoaded", () => {

    const primary = document.querySelector(
        'input[name="primary_color"]'
    );

    const secondary = document.querySelector(
        'input[name="secondary_color"]'
    );

    const heading = document.querySelector(
        'input[name="welcome_heading"]'
    );

    const portal = document.querySelector(
        'input[name="portal_name"]'
    );

    const message = document.querySelector(
        'textarea[name="welcome_message"]'
    );

    const image = document.getElementById(
        "backgroundImage"
    );



    primary?.addEventListener("input", function(){

        document.documentElement.style.setProperty(
            "--primary-color",
            this.value
        );

    });



    secondary?.addEventListener("input", function(){

        document.documentElement.style.setProperty(
            "--secondary-color",
            this.value
        );

    });



    portal?.addEventListener("input", function(){

        const preview=document.querySelector(
            ".preview-title"
        );

        if(preview){

            preview.textContent=this.value;

        }

    });



    heading?.addEventListener("input", function(){

        const preview=document.querySelector(
            ".preview-heading"
        );

        if(preview){

            preview.textContent=this.value;

        }

    });



    message?.addEventListener("input", function(){

        const preview=document.querySelector(
            ".preview-message"
        );

        if(preview){

            preview.textContent=this.value;

        }

    });



    image?.addEventListener("change",function(){

        const file=this.files[0];

        if(!file) return;

        const reader=new FileReader();

        reader.onload=function(e){

            const bg=document.querySelector(
                ".portal-preview"
            );

            if(bg){

                bg.style.backgroundImage=
                    `url(${e.target.result})`;

            }

        };

        reader.readAsDataURL(file);

    });

});
