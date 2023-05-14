<template>
    <div id="app-front">
        <Header />
        <main>
            {{ portfolio }}
            <Section id="about-me-section" />
            <Skills id="skills-section" />
            <router-view id="projects-section"></router-view>
            <Contacts id="contact-me" />
        </main>
        <Footer />
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

<style scoped lang="scss"></style>
