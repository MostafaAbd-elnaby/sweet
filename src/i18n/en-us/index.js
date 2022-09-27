// This is just an example,
// so you can safely delete all default props below

export default {
  failed: 'Action faile',
  success: 'Action was successful',
  lang:'Language',
  back:"Back",
  cancel:'Cancel',
  sort:'Sort by',
  categories:'Categories',
  search:'Search',
  create_order:'Create Order',
  cart:'Cart',
  SearchTitle:'Search our Store',
  close:'Close',
  history:"Orders history",
  likeMess:'You Might Also Like',
  shipPolicie_1:'Shipping cost is based on weight. Just add products to your cart and use the Shipping Calculator to see the shipping price',
  shipPolicie_2:'We want you to be 100% satisfied with your purchase. Items can be returned or exchanged within 30 days of delivery.',
  shipRetturn_1:'Shipping cost is based on weight. Just add products to your cart and use the Shipping Calculator to see the shipping price.',
  shipRetturn_2:'We want you to be 100% satisfied with your purchase. Items can be returned or exchanged within 30 days of delivery.',
  checkLog:'Login befor You write a review',
  remove:'Remove',
  Searchprod:'Search products',
  myAcc:'My Account',
  phone:'phone',
  passText:'Leave it blank if you dont want to change',
  save:'Save',
  PInfo:'Personal Information',
  signUp:'Sign up',
  firstOrder:'Make your first order. You havent placed any orders yet',




    //////////////////////
    //accounts info page//
    //////////////////////
    accounts:{
    login:'LogIn',
    logout:'Logout',
    Profile:'Profile',
    Register:'Register',
    form:{
      placeholderName:'Name',
      placeholderPass:'password',
      ForgetPass:'Forget password ?'

    },
  },
    /////////////////////
    //Payment info page//
    /////////////////////
    Payment:{
    title:'Payment & Checkout',
    info:'Shipping Info',
    name:'Name',
    contact:'contact',
    ShipTo:'Ship to',
    paymentCard:{
      PaymentTilte:'Payment',
      error:'Sorry! payment gateway is under maintenance',
      credit:'Credit Card',
      cardName:'Name on card',
      cardNumber:"Card number",
      expiration:"Expiration date (MM / YY)",
      securityCode:"Security Code",
      noInput:'Please type something'
    },
    ShippingMethod:{
       title:'Shipping Method',
       cash:'Cash on deliviery' ,
       visa:'VISA',
    }
  },
    /////////////////////
    //shaping info page//
    /////////////////////
    shipingInfo:{
      title:'Information',
      contact:'Contact Information',
      check:'Already have an account?',
      login:'Login',
      address:'Shipping Address',
      placeholderPhone:'phone',
      placeholderName:'Full Name',
      placeholderEmail:'Email Address',
      placeholderAddress:' Address',
      placeholderCity:' Address',
      placeholderCity:'City',
      placeholderCountry:'Country',
      placeholderGov:'Governorate',
      placeholderPC:'Post Code',
      checkout:"countinue to checkout",
      validation:{
        name:'Please type your full name',
        fName:'Please type your first name',
        email:'Please type valid email',
        phone:'Please type your phone number',
        adress:'Please type your address',
        city:'Please type your city',
        country:'Please type your country',
        postCode:'Please type your post code',
        gov:'Please type your Governorate',
        pass:'Must be 8 characters or numbers '

      },
    },
    /////////////////////
    /////About page//////
    /////////////////////
  about:{
    title:'About US',
    services:{
      title:'Why Choose us'
    }
  },
    /////////////////////
    //////Card page//////
    /////////////////////
    card:{
    title:'Shopping Cart',
    tax:'Tax and shipping will calculated at checkout',
    empty:'Your cart is Empty',
    view:'View Cart',
    coupon:{
    title:'Coupon',
    discount:'Add a discount code',
    validCoupon:'Valid coupon thanks for purchase from our store',
    invalidCoupon:'This coupon is invalid'
    }
  },
    /////////////////////
    //////Error page/////
    /////////////////////
    Error:{
    title:'Oops. Nothing here...',
    return:'Go Home'
    },
    /////////////////////
    /////Index page//////
    /////////////////////
    index:{
    title:'Season Collection',
    someProducts:'Some Of Our Products',
    labelButton:'Shop Now'
    },
    /////////////////////
    ///shop print page///
    /////////////////////
    shopPrint:{
      title:'Custom Design',
      noProducts:'Sorry! no products founded try to remove some of the filter',
      filter:'Filter',
      select:'Select design',
      custom:'Customize',
      clear:'Clear Filter'
    },
    /////////////////////
    //////shop  page/////
    /////////////////////
    shop:{
      title:'Shop',
      filter:{
        title:'Filters',
        remove:'Remove All Filters',
        size:'size',
        colors:'Colors',
        Prices:'Prices',
        currency:'ASC',
        Brands:'Brands',
        collections:'Collections'
      },
      product:{
        sale:'Sale',
        select:'Select options',
        PrintText:{
          title:'you can Build or upload your own design',
          price:'Back printing price',
          colors:'Colors',
          size:'Size',
          quant:'quantity',
          add:'Add to cart',
          buy:'Buy it now',
          quic_cust:'Quick View / Customize',
          quic:'Quick View'



        }
      },
    },
    /////////////////////
    ////////Lnks/////////
    /////////////////////
    links: {
      home: "Home",
        shop: "Shop",
        custom: "Custom Design",
        about: "About",
        profile:"Profile",
        ar:"Arabic",
        en:"English",
    },
    /////////////////////
    ////fotter deskop////
    /////////////////////
    services:{
      title_1:'Money Guarantee',
      title_2:'Online Support',
      title_3:'Flexible Payment',
      desc_1:'Within 30 days for an exchange',
      desc_2:'24 hourse a day, 7 days a week',
      desc_3:'Pay with Multible Credit Card',
    },
    /////////////////////
    ////fotter deskop////
    /////////////////////
    ui:{
      allColors:'All Colors',
      checkout:'Check out'
    },
    /////////////////////
    ////Shopping Cart////
    /////////////////////
    ShopCard:{
      product:'Product',
      products:'Products',
      size:'Size',
      price:'Price',
      quantity:'Quantity',
      total:'Total',
      subtitle:'Your Product',
      color:'color',
      empty:'Your cart is Empty',
      return:'Return to shop',
      subTotal:'Subtotal',
      shippingT:'shipping',
      discount:'Discount coupon',
      total:'Total',
      tax:'Tax',

    },
    /////////////////////
    /////review page/////
    /////////////////////

    review:{
      rating:'Rating',
      title:'reviews',
      reviewT:'Review Title',
      desc:'Product Description',
      ShipRet:'Shipping Return',
      policies:'Shipping policies',
      reviews:'Product Reviews',
      customer:'Customer Reviews',
      Based:'Based on',
      write:'Write a review',
      body:'Body of Review',
      placeholderRev:'Give Your review a title',
      placeholderWrite:'Write your comments here',
      placeholdertype:'Please type something',
      submit:'Submit Review',
    },
    /////////////////////
    /////////order///////
    /////////////////////
    order:{
      num:'Order number',
      count:'Products count',
      sup:'Subtotal',
      ship:'Shipping',
      total:'Total',
      status:'Status',
      validation:{
        num:'Please type your order number'
      }
    },
    /////////////////////
    ///////profile///////
    /////////////////////
    tabs: {
      info: {
        title: 'Your Information',
        tooltip: 'profile'
      },
      orders: {
        title: 'Your Orders',
        tooltip: 'Orders'
      },
      track_order: {
        title: 'TRACK YOUR ORDER',
        tooltip: 'Track your order'
      },
    }
}

