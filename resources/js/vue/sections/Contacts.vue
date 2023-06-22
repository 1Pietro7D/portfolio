<template>
    <section id="contact-me">
        <h1>Contact me</h1>
        <div v-for="contact of contacts" :key="contact.id">
            {{ contact.name }} : <a :href="contact.contact">{{ contact.contact }}</a>
            <i class="contact-icon" :class="contact.icon.font6_class"></i>
            <div v-if="contact.name == 'email' || contact.icon.name == 'email'">
                <form method="post" action="https://formspree.io/f/xzbqnqzg">
                    <div class="input-box">
                        <input type="text" placeholder="Full Name" name="name" required>
                        <input type="email" placeholder="Email" name="email" required>
                    </div>
                    <div class="input-box">
                        <input type="text" placeholder="Email Subject" name="subject" required>
                    </div>
                    <textarea name="message" cols="30" rows="10" placeholder="Your Message" required></textarea>
                    <input type="submit" value="Send Message" class="btn">
                </form>
            </div>
        </div>
        <button @click="bypass()">bypass</button>
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
        console.log('Contacts mounted.')
    },
    methods: {
        bypass() {
            const xhr = new XMLHttpRequest()
            const url = "https://formspree.io/f/xzbqnqzg";
            const params = `email=${this.email}&name=${this.name}&subject=${this.subject}&message=${this.message}`;

            xhr.open('POST', url, true);

            xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
            xhr.setRequestHeader("Accept", "application/json");


            xhr.onreadystatechange = () => {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = xhr.responseText;
                    alert("inviato con successo");
                    //window.location.href = "/#contact-me-section";
                }
            }
            xhr.send(params);
        },
        // COPY EMAIL BUTTON
        copyToClipboard(text) {
            var input = document.createElement('textarea');
            input.style.position = 'fixed';
            input.style.opacity = 0;
            input.value = text;
            document.body.appendChild(input);
            input.select();
            document.execCommand('Copy');
            document.body.removeChild(input);
            var confirmation = document.getElementById("copyConfirmation");
            confirmation.style.display = "inline";
            setTimeout(function () {
                confirmation.style.display = "none";
            }, 1500);
        },
    }
}
</script>

<style scoped lang="scss">
section {
    background-color: #767bb3;
    text-align: center;
}
</style>
