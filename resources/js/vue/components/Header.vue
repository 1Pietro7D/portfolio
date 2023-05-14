<template>
    <header>
        <nav>
            <div v-for="link of links" :key="link">
                <a :href="link.path">{{ link.label }}</a>
            </div>

        </nav>
    </header>
</template>

<script>
export default {
    name: 'Header',
    data() {
        return {
            links: [
                {
                    label: 'About me',
                    path: '#about-me-section'
                }, {
                    label: 'Skills',
                    path: '#skills-section'
                }, {
                    label: 'Projects',
                    path: '#projects-section'
                }, {
                    label: 'Contact me',
                    path: '#contact-me-section'
                }
            ]
        }
    },
    mounted() {
        console.log('Header mounted.')
    }

}

</script>

<style scoped lang="scss"></style>
