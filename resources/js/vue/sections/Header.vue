<template>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#start-page">Portfolio</a>
                <!--router-link :to="{ name: 'home' }" class="navbar-brand">Portfolio</router-link-->
                <button class="navbar-toggler" type="button" id="navbarTogglerSupported" data-toggle="collapse"
                    data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse text-right" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li v-for="(link, i) of links" :key="i" class="nav-item ml-3 py-2">
                            <router-link @click.native="redirect(link.path)" :to="{ name: 'home', hash: link.path }">
                                {{ link.label }}
                            </router-link>
                            <!-- <a :href="link.path"> {{ link.label }}</a> -->
                        </li>
                        <li class="nav-item ml-3 py-2">
                            <a href="../back">BackOffice</a>
                        </li>
                    </ul>
                </div>
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
                },
            ]
        }
    },
    mounted() {
        console.log('Header mounted.')
    },
    methods: {

        redirect(elementId) {
            const element = document.querySelector(elementId);
            if (element) {
                element.scrollIntoView({ behavior: 'smooth' });
            }
        },
    },

}

</script>

<style scoped lang="scss">
a {
    color: white;
}
</style>
