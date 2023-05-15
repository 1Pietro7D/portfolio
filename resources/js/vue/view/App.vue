<template>
    <div id="app-front">
        <div v-if="loading">Loading</div>
        <div v-else-if="portfolio" class="layout-container">
            <Header />
            <main>
                <Section id="about-me-section" :section="portfolio.section" />
                <Skills id="skills-section" :skills="portfolio.skills" />
                <router-view id="projects-section"
                    :projects="portfolio.projects"><!-- props for only ProjectsCarousel --></router-view>
                <Contacts id="contact-me" :contacts="portfolio.contacts" />
            </main>
            <Footer />
        </div>
        <div v-else>Errore</div>
    </div>
</template>


<script>

import Header from '../components/Header.vue';
import Section from '../components/Section.vue';
import Skills from '../components/Skills.vue';
import Contacts from '../components/Contacts.vue';
import Footer from '../components/Footer.vue';


export default {
    name: 'app-front',

    components: {
        Header,
        Section,
        Skills,
        Contacts,
        Footer
    },
    data() {
        return {
            portfolio: undefined,
            loading: true
        }
    },
    mounted() {
        this.loadPage('api/portfolio');
    },
    methods: {
        loadPage(url) {
            axios.get(url)
                .then(({ data }) => {
                    if (data.success) {
                        this.portfolio = data.results;
                        this.loading = false;
                    } else {
                        this.$route.push({ name: 'NotFound' });
                    }

                })
                .catch(e => {
                    console.log('errore', e);
                    this.loading = false;
                })
        }
    }
}

</script>

<style scoped lang="scss">
.layout-container {
    display: flex;
    flex-direction: column;
    height: 100vh;

    main {
        overflow-y: scroll;
        flex-grow: 1;
    }

    header,
    footer {
        flex-shrink: 0;
    }
}
</style>
