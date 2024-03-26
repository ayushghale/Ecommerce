-- table name
    User
    Category
    Product
    Order
    OrderDetail
    Cart
    Payment
    Review

-- php artisan make:model User -mcr
-- php artisan make:model Category -mcr
-- php artisan make:model Product -mcr
-- php artisan make:model Order -mcr
-- php artisan make:model OrderDetail -mcr
-- php artisan make:model Cart -mcr
-- php artisan make:model Payment -mcr
-- php artisan make:model Review -mcr



-- User table
    id
    name
    image
    email
    location
    contact_number
    password
    created_at
    updated_at

-- Category table
    id
    name
    created_at
    updated_at

-- Product table
    id
    name
    price
    description
    image
    category_id
    created_at
    updated_at

-- Order table
    id
    user_id
    total
    status
    created_at
    updated_at

-- OrderDetail table
    id
    order_id
    product_id
    quantity
    price
    created_at
    updated_at

-- Cart table
    id
    user_id
    product_id
    quantity
    created_at
    updated_at

-- Payment table
    id
    order_id
    payment_id
    status
    created_at
    updated_at

-- Review table
    id
    user_id
    product_id
    rating
    review
    created_at
    updated_at

