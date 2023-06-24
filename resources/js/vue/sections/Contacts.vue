<template>
    <section id="contact-me-section" class="my-flex-section">
        <h1>Contact me!</h1>
        <form id="my-form" action="https://formspree.io/f/xzbqnqzg" method="POST">
            <div class="input-box">
                <input type="text" placeholder="Full Name" name="name" required>
                <input type="email" placeholder="Email" name="email" required>
            </div>
            <div class="input-box">
                <input type="text" placeholder="Email Subject" name="subject" required>
            </div>
            <div class="input-box">
                <textarea name="message" cols="30" rows="10" placeholder="Your Message" required></textarea>
            </div>
            <button id="my-form-button" class="btn btn-info">Submit</button>
            <p id="my-form-status"></p>
        </form>
        <div>
            <h2>Other contact</h2>
            <div v-for="contact of contacts" :key="contact.id">
                <div v-if="contact.name == 'email' || contact.icon.name == 'email'" class="contact-item-box">

                    <i class="contact-icon" :class="contact.icon.font6_class"></i>
                    <span>{{ contact.name }} </span><span> {{ contact.contact }}</span>
                    <div @click="copyToClipboard(contact.contact)" class="copy-email-btn"><i class='fa-solid fa-copy'></i>
                        <span id="copyConfirmation" style="display: none;">Copied!</span>
                    </div>

                </div>
                <div v-else class="contact-item-box">
                    <i class="contact-icon" :class="contact.icon.font6_class"></i>
                    <span> {{ contact.name }} </span> <a :href="contact.contact">{{ contact.contact }}</a>
                </div>
            </div>
        </div>
        <!-- Disable -->
        <button @click="bypass()" class="d-none">bypass form</button>
    </section>
</template>

<script>
export default {
    name: 'Contacts',
    data() {
        return {
            email: "danieli.pietro94@gmail.com",
            name: "Pietro",
            subject: "Bypass",
            message: "questo messaggio è del bypass"
        }
    },
    props: {
        contacts: Array
    },
    mounted() {
        console.log('Contacts mounted.');
        const form = document.getElementById("my-form");

        async function handleSubmit(event) {
            event.preventDefault();
            const status = document.getElementById("my-form-status");
            const data = new FormData(event.target);
            fetch(event.target.action, {
                method: form.method,
                body: data,
                headers: {
                    'Accept': 'application/json'
                }
            }).then(response => {
                if (response.ok) {
                    status.classList.add("status-ok");
                    status.innerHTML = "Thanks for your submission!";
                    form.reset()
                } else {
                    response.json().then(data => {
                        if (Object.hasOwn(data, 'errors')) {
                            status.classList.add("status-error");
                            status.innerHTML = data["errors"].map(error => error["message"]).join(", ");
                        } else {
                            status.classList.add("status-error");
                            status.innerHTML = "Oops! There was a problem submitting your form";
                        }
                    })
                }
            }).catch(error => {
                status.classList.add("status-error");
                status.innerHTML = "Oops! There was a problem submitting your form"
            });
        }
        form.addEventListener("submit", handleSubmit)
    },
    methods: {
        // bypass() {
        //     const xhr = new XMLHttpRequest()
        //     const url = "https://formspree.io/f/xzbqnqzg";
        //     const params = `email=${this.email}&name=${this.name}&subject=${this.subject}&message=${this.message}`;


        //     xhr.open('POST', url, true);

        //     xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
        //     xhr.setRequestHeader("Accept", "application/json");


        //     xhr.onreadystatechange = () => {
        //         if (xhr.readyState === 4 && xhr.status === 200) {
        //             const response = xhr.responseText;
        //             alert("inviato con successo");
        //             //window.location.href = "/#contact-me-section";
        //         }
        //     }
        //     xhr.send(params);
        // },
        // COPY EMAIL BUTTON
        copyToClipboard(text) {
            const input = document.createElement('textarea');
            input.style.position = 'fixed';
            input.style.opacity = 0;
            input.value = text;
            document.body.appendChild(input);
            input.select();
            document.execCommand('Copy');
            document.body.removeChild(input);
            const confirmation = document.getElementById("copyConfirmation");
            confirmation.style.display = "inline";
            setTimeout(function () {
                confirmation.style.display = "none";
            }, 1500);
        },
    }
}
</script>

<style scoped lang="scss">
#contact-me-section {
    background-color: #767bb3;
    text-align: center;

    .contact-item-box {
        display: flex;
        gap: 1rem;
        justify-content: center;
        padding: .5rem;
        align-items: center;
    }

    @media screen and (max-width: 320px) {
        .contact-item-box {
            gap: .5rem;
        }
    }

    #my-form {
        .input-box {
            padding: .5rem 0;

            * {
                border-radius: 6px;
            }
        }


        .status-ok {
            border: 2px solid green;
            border-radius: 4px;
        }

        .status-error {
            border: 2px solid red;
            border-radius: 4px;
        }
    }

    .copy-email-btn {
        cursor: pointer;
        background: var(--bg-color);
        position: relative;
    }

    .copy-email-btn i {
        vertical-align: bottom;
        font-size: 2rem;
        color: var(--main-color);
    }

    #copyConfirmation {
        font-size: 1.5rem;
        color: #fff;
        position: absolute;
        top: -20px;
        left: -18px;
    }

}
</style>
