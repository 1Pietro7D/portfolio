<template>
    <section>
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
    }
}

</script>

<style scoped lang="scss">
section {
    background-color: aquamarine;
}
</style>
