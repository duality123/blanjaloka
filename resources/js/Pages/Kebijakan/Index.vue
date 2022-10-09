<template>
    <LayoutVue>
        <div class="container">
            <h2>Kebijakan Privasi</h2>
            
            <div class="kebijakan-privasi">
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aliquam sunt exercitationem ipsa! Perferendis, molestiae nemo modi blanditiis reiciendis nostrum ipsum quis! Repellat nihil cum harum atque ipsam magnam illum, veniam mollitia, ipsa architecto consequuntur reiciendis culpa vitae adipisci. Culpa totam architecto illum enim vero nulla reprehenderit, repellat, sequi ad corrupti aliquid officiis deserunt rerum modi ut, quisquam dicta illo at! Nemo, nam eos! Eveniet fugiat rem officia aut, doloremque voluptas eaque id impedit ducimus. Officiis, cum. Saepe, quis modi. Sit, temporibus numquam dolorem sunt dolor maiores? Veritatis vero, eveniet repellendus illo at atque neque nam quo quibusdam recusandae, eligendi quas pariatur odio perspiciatis reprehenderit amet minus tenetur repellat debitis iure ab! Illo modi sint nisi, asperiores officiis doloremque sequi amet ut quae deserunt praesentium veritatis illum! Odio debitis temporibus, commodi eveniet excepturi magnam qui quisquam nihil ex autem corporis quaerat officiis blanditiis voluptates maiores! Tempore, necessitatibus obcaecati! Alias, facere ut.</p>
                
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis dolores incidunt quos hic deleniti aperiam earum aut facere labore amet itaque, sequi, nisi aliquid modi minima quae tenetur odio perspiciatis praesentium cumque saepe aspernatur animi. Aperiam officia, amet, asperiores eos maiores beatae, nihil tempora nostrum aut vero necessitatibus dignissimos magni ipsum! Eum voluptatibus, facere ipsum fuga dolorum eveniet harum ut quidem doloribus autem tempora beatae voluptate tenetur adipisci eligendi facilis blanditiis culpa ex suscipit consectetur illo repudiandae impedit placeat veritatis.</p>
                
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Inventore commodi quasi deserunt eos ad ipsa culpa impedit quidem voluptatum repudiandae soluta laboriosam architecto amet perspiciatis id eaque assumenda, dicta esse voluptas doloribus maiores sed iste reprehenderit nihil. Praesentium, sed nemo voluptas delectus ullam obcaecati. Officiis asperiores in, quisquam laborum vel, voluptates obcaecati architecto fugit aliquid veniam facilis sequi itaque sunt temporibus officia laudantium saepe debitis repellendus omnis dolorem autem placeat fuga quasi excepturi? Aliquid recusandae deserunt, impedit nihil fugit id dolorem temporibus, omnis provident accusantium iste debitis et ab voluptates quos vero praesentium quo fugiat perspiciatis dignissimos, similique magni in!</p>
                
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos velit tempore temporibus qui suscipit soluta. Possimus animi at laudantium inventore voluptate blanditiis et quae, commodi sit hic nobis doloribus omnis sint similique maiores. Reiciendis qui nisi molestiae modi expedita iusto cumque eum nemo! Dolorem autem, blanditiis praesentium voluptas quo ipsam?</p>
                
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aperiam dolores alias voluptate ex vel neque magnam exercitationem. Sequi sed laudantium cumque temporibus perspiciatis cum saepe repellendus quibusdam officia magni, ducimus accusamus maxime qui beatae consequuntur necessitatibus possimus earum similique aliquid. Temporibus dolores corrupti non fugiat doloribus dolore eius quis repellendus voluptates, culpa quas, eaque corporis libero rerum. Nulla, quasi dicta ex molestiae, quos alias velit minus quidem error, dolore blanditiis! Dolor voluptatem, ipsam quidem fugit excepturi enim sed, nobis magni animi placeat cumque commodi blanditiis obcaecati numquam nesciunt repellendus amet minima alias reiciendis repudiandae facere possimus. Consequatur libero aliquam ipsum!</p>
                
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veritatis officia necessitatibus quas distinctio, quia explicabo ad dolorem maxime quaerat eveniet dicta nobis reiciendis! Labore magni rem architecto sit provident veniam.</p>
            </div>
            
            <div class="d-flex justify-content-center mt-5 mb-3">
                <input class="form-check-input mt-1 me-2" type="checkbox" value="" aria-label="Checkbox for following text input" @click="handleToggleButtonLanjut">
                <p>Saya telah membaca dan menyetujui Kebijakan Privasi dari aplikasi Blanjaloka Akselerator seperti yang tertera diatas</p>
            </div>
            
            <div class="d-flex justify-content-center my-2">
                <button class="btn btn-lanjut btn-primary-blue-6 text-white px-4 py-2" :disabled="toggleButtonLanjut" @click="handleButtonLanjut">Lanjutkan</button>
            </div>
        </div>
    </LayoutVue>
</template>

<script>
    import { ref } from 'vue';
import LayoutVue from '../../Layouts/Layout.vue';
    export default{
        components:{
            LayoutVue
        },

        setup(){
            const toggleButtonLanjut = ref(true);

            const handleToggleButtonLanjut = () =>{
                toggleButtonLanjut.value = !toggleButtonLanjut.value;
            }

            const handleButtonLanjut = () => {
                window.location.href = '/register'
            }
            return {toggleButtonLanjut, handleToggleButtonLanjut, handleButtonLanjut}
        }
    }
</script>

<style scoped>
    
    h2{
        font-family: 'Inter';
        font-style: normal;
        font-weight: 600;
        font-size: 34px;
        line-height: 140%;
        color: #181A1B;
    }
    
    .kebijakan-privasi{
        margin-top: 32px;
    }
    
    .btn-lanjut{
        width: 400px;
        height: 46px;
    }
</style>
