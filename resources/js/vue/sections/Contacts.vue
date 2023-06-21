<template>
    <section id="contact-me">
        <h1>Contact me</h1>
        <div v-for="contact of contacts" :key="contact.id">
            {{ contact.name }} : {{ contact.contact }}
            <i class="contact-icon" :class="contact.icon.font6_class"></i>
            <div v-if="contact.icon.name == 'email'">
                next implement email
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: 'Contacts',

    props: {
        contacts: Array
    },
    mounted() {
        console.log('Contacts mounted.')
    },
    methods: {
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
