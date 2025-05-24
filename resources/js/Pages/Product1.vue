<template>
    <section class="main-section">
        <div class="product-detail-container">
            <div v-if="productData" class="product-card-detail">
                <div class="image-gallery">
                    <img v-if="mainImage" :src="`/images/${mainImage}`" :alt="productData.name" class="main-product-image">
                    <div class="thumbnail-row">
                        <img
                            v-for="(img, index) in productData.images"
                            :key="index"
                            :src="`/images/${img}`"
                            @click="setMainImage(img)"
                            :class="['thumbnail', { 'active-thumbnail': mainImage === img }]"
                            alt="Product thumbnail"
                        />
                    </div>
                </div>
                <div class="product-info">
                    <h1 class="title-detail">{{ productData.name }}</h1>
                    <p class="description">{{ productData.description }}</p>
                    <div class="price-detail">{{ productData.price }}р</div>
                    <button class="add-to-cart-button">Добавить в корзину</button>
                    </div>
            </div>
            <div v-else class="loading-message">
                Загрузка информации о товаре...
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props: {
        productData: {
            type: Object,
            required: true,
            default: () => ({})
        }
    },
    data() {
        return {
            mainImage: this.productData.image || (this.productData.images && this.productData.images.length > 0 ? this.productData.images[0] : null)
        };
    },
    watch: {
        // Следим за изменением productData и обновляем основное изображение
        productData: {
            handler(newVal) {
                if (newVal) {
                    this.mainImage = newVal.image || (newVal.images && newVal.images.length > 0 ? newVal.images[0] : null);
                }
            },
            deep: true,
            immediate: true
        }
    },
    methods: {
        setMainImage(image) {
            this.mainImage = image;
        }
    }
}
</script>

<style scoped>
.main-section {
    color: white;
    font-family: "Montserrat";
    width: 100%;
    min-height: 100vh;
    padding: 20px;
    box-sizing: border-box;
    display: flex;
    justify-content: center;
    align-items: flex-start; /* Изменено на flex-start, чтобы контент был сверху */
    padding-top: 50px; /* Отступ сверху */
}

.product-detail-container {
    max-width: 1200px;
    width: 100%;
    background-color: #2c2c2c; /* Цвет фона для контейнера деталей товара */
    border-radius: 10px;
    padding: 30px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.product-card-detail {
    display: flex;
    flex-wrap: wrap; /* Для адаптивности на маленьких экранах */
    gap: 40px;
    justify-content: center; /* Центрирование содержимого */
}

.image-gallery {
    flex: 1;
    min-width: 300px; /* Минимальная ширина для галереи изображений */
    max-width: 500px; /* Максимальная ширина */
    display: flex;
    flex-direction: column;
    align-items: center;
}

.main-product-image {
    width: 100%;
    height: auto;
    max-height: 400px; /* Ограничение высоты для основного изображения */
    object-fit: contain; /* Чтобы изображение полностью помещалось */
    border-radius: 8px;
    margin-bottom: 15px;
    border: 1px solid #444;
}

.thumbnail-row {
    display: flex;
    gap: 10px;
    overflow-x: auto; /* Прокрутка для миниатюр, если их много */
    padding-bottom: 5px; /* Отступ для скроллбара */
}

.thumbnail {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 5px;
    cursor: pointer;
    border: 2px solid transparent;
    transition: all 0.2s ease;
}

.thumbnail:hover {
    border-color: #ffd700;
}

.active-thumbnail {
    border-color: #ffd700;
    box-shadow: 0 0 5px rgba(255, 215, 0, 0.5);
}

.product-info {
    flex: 2;
    min-width: 300px; /* Минимальная ширина для информации о товаре */
    padding-left: 20px;
    border-left: 1px dashed #555; /* Разделитель */
}

.title-detail {
    font-size: 36px;
    margin-bottom: 15px;
    color: #ffd700;
}

.description {
    font-size: 18px;
    line-height: 1.6;
    margin-bottom: 25px;
    color: #e0e0e0;
}

.price-detail {
    font-size: 30px;
    font-weight: bold;
    color: #ffd700;
    margin-bottom: 30px;
}

.add-to-cart-button {
    background-color: #884535;
    color: white;
    padding: 15px 30px;
    border: none;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.add-to-cart-button:hover {
    background-color: #a05e4a;
}

.loading-message {
    text-align: center;
    font-size: 24px;
    color: #ccc;
    padding: 50px;
}

/* Адаптация для мобильных устройств */
@media (max-width: 900px) {
    .product-card-detail {
        flex-direction: column;
        align-items: center;
    }

    .image-gallery, .product-info {
        min-width: unset;
        width: 100%;
        padding-left: 0;
        border-left: none;
    }

    .product-info {
        text-align: center;
        padding-top: 30px;
        border-top: 1px dashed #555; /* Разделитель сверху для мобильных */
    }

    .title-detail {
        font-size: 28px;
    }

    .price-detail {
        font-size: 24px;
    }
}

@media (max-width: 600px) {
    .product-detail-container {
        padding: 20px;
    }
}
</style>