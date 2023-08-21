import state from './state'

const mutations = {
  increment(state) {
    state.count++
  },
  setUser(state, user) {
    state.user = user
  },
  setCategories(state, categories) {
    state.categories = [...categories]
  },
  setProducts(state, products) {
   
    state.products = [...products]
  },
  setColors(state, colors) {
    state.colors = [...colors]
  },
  setSizes(state, sizes) {
    state.sizes = [...sizes]
  },
  //Trạng thái đăng nhập
  setAuthentication(state, value) {
    state.isAuthenticated = value
  },
  setFavoriteProduct(state, value) {
    state.favoriteProduct = value
  },
  setCarts(state,value){
    state.carts = value;
  }
}

export default mutations
