<template>
    <section>
        {{ project }}
    </section>
</template>

<script>
export default {
    name: 'ProjectDetail',
    data() {
        return {
            project: null
        }
    },
    mounted() {
        console.log('Project mounted.')
        this.loadPage('api/portfolio/' + this.$route.params.slug);
    },
    methods: {
        loadPage(url) {
            axios.get(url)
                .then(({ data }) => {
                    if (data.success) {
                        this.project = data.result;
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
