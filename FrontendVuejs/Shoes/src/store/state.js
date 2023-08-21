
const state ={
    count: 0,
    token:localStorage.getItem('token'),
    user:null,
    categories:[],
    products:[],
    colors:[],
    sizes:[],
    favoriteProduct:[],
    carts:[],

    isAuthenticated:false//Trạng thái đăng nhập

    
}
export default state
