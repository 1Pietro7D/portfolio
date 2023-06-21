<template>
    <section id="about-me-section" class="my-flex-section">
        <h1>{{ section.title }}</h1>

        <div class="section-container">
            <div class="my-img-container">
                <div class="my-img-cover">
                    <img :src="'/storage/' + section.img_path" :alt="section.title" class="my-img-fluid" />
                </div>
            </div>
            <div class="section-details">
                <h3>{{ section.paragraph }}</h3>
                <!-- <a href="/cv/download">Scarica il Curriculum Vitae</a> -->
                <div class="cv-container">
                    <h4>Scarica o apri il Curriculum Vitae</h4>
                    <div class="btns-container">
                        <form action="/cv/download" method="GET">
                            <button type="submit" class="btn-cv download"><i class="fa-solid fa-download"></i></button>
                        </form>
                        <form action="/cv/view" method="GET" target="_blank">
                            <button type="submit" class="btn-cv view"><i class="fa-solid fa-eye"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
#about-me-section {
    background-color: black;
    color: white;

    .section-container {
        display: flex;
        align-items: center;
        gap: 2rem;

        .my-img-container {
            padding: 1rem;
            margin: auto;


            .my-img-cover {
                width: 400px;
                height: 400px;
                border: 5px solid white;
                border-radius: 1rem;

                img {
                    border-radius: calc(1rem - 5px); // Sottrai la misura del bordo dall'arrotondamento del bordo
                }

            }
        }

        .btns-container {
            display: flex;
            padding: .5rem;
            gap: .5rem;

            .btn-cv {
                width: 38px;
                height: 38px;
                border-radius: 50%;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .btn-cv.download {
                background-color: aqua;
            }

            .btn-cv.view {
                background-color: rgb(0, 255, 0);
            }
        }


    }

    @media screen and (max-width: 1200px) {
        .section-container {
            flex-wrap: wrap-reverse;
        }
    }
}
</style>
