import state from './state'

const getters = {
  //user
  getUserName(state) {
    return state.user.name
  },
  getUser(state) {
    return state.user
  },
  //-------------------
  sortProductsByDate(state) {
    state.products.sort((a, b) => new Date(b.created_at) - new Date(a.created_at))
    const a = state.products
    return a.slice(0, 8)
  },
  getCategoriesName(state) {
    const CategoriesName = state.categories.map((category) => category.name)
    return [...CategoriesName]
  },
  getCategories(state) {
    return [...state.categories]
  },
  getProductById: (state) => (id) => {
    return state.products.find((product) => product.id === id)
  },
  getProductByCategory: (state) => (category_id, product_id) => {
    const productsInCategory = state.products.filter((product) => {
      return product.category.id === category_id && product.id !== product_id
    })
    // Giới hạn số lượng sản phẩm trả về (4 sản phẩm)
    const limitedProducts = productsInCategory.slice(0, 4)
    return limitedProducts
  },
  getColors(state) {
    return state.colors
  },
  getSizes(state) {
    return state.sizes
  },
  getAllProductByCategory: (state) => (id) => {
    let a = state.products.filter((product) => product.category_id === id)
    return a
  },
  //Sản phẩm yêu thích
  getFavoriteProduct(state) {
    return state.favoriteProduct
  },
  getAllProducts(state) {
    return state.products
  },
  //
  
  //Lấy ra trạng thái đăng nhập
  getisAuthenticated(state) {
    return state.isAuthenticated
  },
  getCarts(state) {
    return state.carts
  }
}
export default getters
