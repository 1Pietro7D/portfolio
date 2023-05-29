<template>
    <section id="about-me-section">
        <H1>{{ section.title }}</H1>
        <img :src="'/storage/' + section.img_path" :alt="section.title" class="img-section">
        <span>{{ section.paragraph }}</span>
    </section>
</template>

<script>
export default {
    name: 'Section',

    props: {
        section: Object
    },
    mounted() {
        console.log('About-me mounted.')
    }

}

</script>

<style scoped lang="scss">
.img-section {
    width: 300px;
    height: 300px;
}
</style>
