<template>
    <div class="blog-container">
        <div class="blog-image-container col-md-12">
            <img class="img-fluid" :src="blog.image">
        </div>
        <div class="blog-title col-md-12"> {{ blog.title }}</div>
        <div class="blog-content-container col-md-12">
            <div class="blog-content"> {{ blog.content }}</div>
        </div>
        <div class="col-md-12">
            <button type="button">
                <v-icon>plus</v-icon>
            </button>
            <button type="button">
                <v-icon>delete</v-icon>
            </button>
        </div>
    </div>
</template>

<script>

export default {
    title: 'BlogPost',
    data: () => ({
        blog:
            { 
                image: require(`../assets/logo.png`),
                title: 'Test Blog',
                content: 'Test Blog Content'
            },
        cart: true,
    }),

    methods : {
        
    }
}
</script>

<style lang="scss" scoped>

.blog-container {
    transition: box-shadow .3s;
    background-color: #fff;
    border-radius: 1rem;
    padding: 0.625rem;
    text-align: center;
    letter-spacing: .01rem;
    font-size: 1rem;
    // width: min-content;
}

.blog-image-container {
    position: relative;
    display: inline-block;
    cursor: pointer;
}

.blog-title {
    color: #023047;
    text-align: center;
    text-overflow: ellipsis;
    font-family: cursive;
    padding: 0px 15px;
}

.blog-content {
    color: #219ebc;
    font-family: cursive;
    font-weight: bold;
}

.blog-container:hover {
    box-shadow: 0.625rem 0.625rem 0.6875rem rgba(142, 202, 230, 0.0588235294);
}

</style>
