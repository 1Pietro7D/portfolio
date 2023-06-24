<template>
    <div id="app-front">
        <div v-if="loading" class="loading">
            <img src="../../../../public/assets/loading-start.gif" alt="loading" class="my-img-fluid">
        </div>
        <div v-else-if="portfolio" class="layout-container">
            <Header />
            <main>
                <div id="start-page"></div>
                <Section id="about-me-section" :section="portfolio.section" />
                <Skills id="skills-section" :skills="portfolio.skills" />
                <Projects id="projects-section" :projects="portfolio.projects" />
                <Contacts id="contact-me-section" :contacts="portfolio.contacts" />
            </main>
            <Footer />
        </div>
        <div v-else>Errore</div>
    </div>
</template>


<script>

import Header from '../sections/Header.vue';
import Section from '../sections/Section.vue';
import Skills from '../sections/Skills.vue';
import Contacts from '../sections/Contacts.vue';
import Footer from '../sections/Footer.vue';
import Projects from '../sections/Projects.vue'

export default {
    name: 'app-front',

    components: {
        Header,
        Section,
        Projects,
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
        redirectByUrl() {
            if (this.$route.hash) {
                const element = document.querySelector(this.$route.hash);
                // console.log(this.$route.hash);
                // console.log(element);
                if (element) {
                    element.scrollIntoView({ behavior: 'smooth' });
                }
            }

        },
        loadPage(url) {
            axios.get(url)
                .then(({ data }) => {
                    if (data.success) {
                        this.portfolio = data.results;
                        setTimeout(() => {
                            console.log("Timeout scaduto dopo 0.3 secondi.");
                            this.loading = false;
                            this.$nextTick(() => {
                                // Il codice qui verrà eseguito dopo che tutti i componenti figlio sono stati caricati
                                this.redirectByUrl();
                            });
                        }, 300);

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

        section {
            min-height: 100%;
        }
    }

    header,
    footer {
        flex-shrink: 0;
    }



    .loading {
        width: 100%;
        height: 100vh;
        padding: 5rem;
        background-color: black;
    }
}
</style>
