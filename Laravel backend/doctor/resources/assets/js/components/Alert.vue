<template>
    <div :class="alertClasses" v-show="show">
        <slot></slot>
        <a href="#!" class="Alert__close" @click="show=false"><i class="material-icons primary-text">close</i></a>
    </div>
</template>
<script>
    export default {
        props:['type'],
        data(){
            return {
                show:true
            };
        },
        computed:{
           alertClasses(){
                var  type= this.type;
                return {
                    'Alert':true,
                    'alert':true,
                    'alert-flash':true,
                    'success': type=='success',
                    'danger': type=='error',
                    'info': type=='info',
                    'warning': type=='warning',
                }
           }
        }
    }
</script>
