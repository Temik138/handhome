<template>
  <section class="main-section">
    <div class="product-container">
      <div class="image-section" v-if="processedProduct && processedProduct.images">
        <div class="thumbnail-gallery">
          <img
            v-for="(image, index) in processedProduct.images"
            :key="index"
            :src="getImageUrl(image)"
            alt=""
            class="thumbnail"
            :class="{ active: currentImageIndex === index }"
            @click="changeImage(index)"
          />
        </div>
        <img
          :src="currentImage" 
          alt="Product main image"
          class="main-image"
          v-if="currentImage"
        />
      </div>

      <div class="product-details" v-if="processedProduct">
        <h2 class="product-title">{{ processedProduct.name }}</h2>
        <p class="product-description">
          {{ processedProduct.description }}
        </p>
        <div class="purchase-section">
          <span class="price">{{ processedProduct.price }} рублей</span>
          <div class="quantity-controls">
            <button class="quantity-btn" @click="decreaseQuantity">-</button>
            <span class="quantity">{{ quantity }}</span>
            <button class="quantity-btn" @click="increaseQuantity">+</button>
          </div>
          <button class="buy-button" @click="addToCart">Купить</button>
        </div>
      </div>
    </div>
  </section>
</template>
  
  <script>
  export default {
  name: 'AppProduct1',
 props: {
  productData: {
    type: Object,
    default: () => ({
      id: undefined,
      name: 'Информация о товаре',
      description: 'Описание загружается...',
      price: 0,
      images: [],
      image: ''
    })
  }
},
  data() {
    return {
      currentImageIndex: 0,
      quantity: 1
    }
  },
  computed: {
    processedProduct() {
      // Логируем полученные productData в консоль браузера
      console.log('AppProduct1.vue - Received productData:', JSON.parse(JSON.stringify(this.productData)));

      if (!this.productData || this.productData.id === undefined) {
        console.error('AppProduct1.vue - productData is missing or has no id. Displaying fallback.');
        return {
          name: 'Товар не найден',
          description: 'К сожалению, информация о данном товаре отсутствует или товар был удален.',
          price: 0,
          images: [],
          image: '', // Можно указать путь к картинке "изображение не найдено"
        };
      }

      let imagesToShow = this.productData.images;

      if ((!imagesToShow || imagesToShow.length === 0) && this.productData.image) {
        imagesToShow = [this.productData.image];
      }
      
      return {
        ...this.productData,
        images: imagesToShow || [],
      };
    },
    currentImage() {
      if (!this.processedProduct || !this.processedProduct.images || this.processedProduct.images.length === 0) {
        // Если галерея пуста, пытаемся показать основное изображение из processedProduct.image
        // или изображение по умолчанию, если и его нет
        return this.getImageUrl(this.processedProduct.image || null); 
      }
      // Убедимся, что currentImageIndex не выходит за пределы массива
      const imagePath = this.processedProduct.images[this.currentImageIndex];
      return this.getImageUrl(imagePath);
    }
  },
  created() {
    // Сбрасываем индекс при загрузке/обновлении данных, если есть изображения
    if (this.processedProduct && this.processedProduct.images && this.processedProduct.images.length > 0) {
      this.currentImageIndex = 0;
    }
    // Можно добавить дополнительную проверку или логику здесь при необходимости
    // console.log('AppProduct1.vue - Component created. Processed product name:', this.processedProduct.name);
  },
  watch: {
    // Если вы переходите между страницами товаров без полной перезагрузки страницы
    // (например, по ссылкам "похожие товары" на этой же странице компонента),
    // то нужно отслеживать изменения productData.id или всего productData
    'productData.id'(newId, oldId) {
      if (newId !== oldId) {
        // console.log(`Product ID changed from ${oldId} to ${newId}. Resetting component state.`);
        this.currentImageIndex = 0;
        this.quantity = 1;
        // Дополнительные сбросы состояния, если нужны
      }
    }
  },
  methods: {
    getImageUrl(imagePath) {
      if (!imagePath) return '/images/'; 
      if (imagePath.startsWith('http')) return imagePath;
      return `/storage/${imagePath}`;
    },
    changeImage(index) {
      if (this.processedProduct?.images?.length > index && index >= 0) { // Добавил index >= 0
        this.currentImageIndex = index;
      }
    },
    increaseQuantity() {
      this.quantity++;
    },
    decreaseQuantity() {
      if (this.quantity > 1) {
        this.quantity--;
      }
    },
    addToCart() {
      // Убедимся, что processedProduct существует и у него есть имя
      if (this.processedProduct && this.processedProduct.id !== undefined) {
        alert(`Добавлено в корзину: ${this.processedProduct.name} (${this.quantity} шт.)`);
      } else {
        alert('Невозможно добавить товар в корзину, товар не найден.');
      }
    }
  }
}
  </script>
  <style scoped>
  /* Ваши существующие стили без изменений */
  .main-section {
    color: white;
    font-family: "Montserrat";
    width: 100%;
    min-height: 100vh;
    padding: 20px;
    box-sizing: border-box;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #884535;
  }
  
  .product-container {
    display: flex;
    max-width: 800px;
    gap: 40px;
    align-items: center;
  }
  
  .image-section {
    display: flex;
    gap: 20px;
  }
  
  .thumbnail-gallery {
    display: flex;
    flex-direction: column;
    gap: 15px;
  }
  
  .thumbnail {
    width: 80px;
    height: 120px;
    object-fit: cover;
    cursor: pointer;
    border: 2px solid transparent;
    transition: all 0.3s;
    border-radius: 5px;
  }
  
  .thumbnail:hover {
    transform: scale(1.05);
  }
  
  .thumbnail.active {
    border-color: #884535;
    transform: scale(1.1);
  }
  
  .main-image {
    width: 350px;
    height: 500px;
    object-fit: cover;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
  }
  
  .product-details {
    font-family: "Montserrat", sans-serif;
    color: white;
    max-width: 400px;
  }
  
  .product-title {
    font-size: 28px;
    font-weight: 600;
    margin-bottom: 20px;
  }
  
  .product-description {
    font-size: 16px;
    line-height: 1.6;
    margin-bottom: 30px;
  }
  
  .purchase-section {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }
  
  .price {
    font-size: 24px;
    font-weight: 600;
  }
  
  .quantity-controls {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
  }
  
  .quantity-btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #884535;
    border: 2px dashed white;
    color: white;
    font-size: 20px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
  }
  
  .quantity-btn:hover {
    background-color: #6d3626;
  }
  
  .quantity {
    font-size: 20px;
    min-width: 30px;
    text-align: center;
  }
  
  .buy-button {
    border-radius: 5px;
    background-color: #884535;
    border: 2px dashed white;
    padding: 15px 40px;
    font-size: 18px;
    color: white;
    cursor: pointer;
    transition: all 0.3s;
    width: 100%;
  }
  
  .buy-button:hover {
    background-color: #6d3626;
    transform: translateY(-2px);
  }
  
  @media (max-width: 768px) {
    .product-container {
      flex-direction: column;
      padding: 20px;
    }
    
    .image-section {
      flex-direction: column-reverse;
      align-items: center;
    }
    
    .thumbnail-gallery {
      flex-direction: row;
      margin-top: 20px;
    }
    
    .main-image {
      width: 100%;
      height: auto;
      max-height: 400px;
    }
    
    .product-details {
      max-width: 100%;
    }
  }
  </style>