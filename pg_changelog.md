# Payment Gateway Changelog

Changelog for Payment Gateway for EDESS UNICREDS
Author : Adib Bazli

## Important Note (v0.4)

- Please import Database v211129
- Remove ALL cart and commission table from DB and import edessPG (latest pull)
- Remove enrolled_course_studuni and enrolled_mc_studuni table from DB and import 
unicreds_su_enrolled until constraint fixed from latest DB
- Open port 80 from internet for Payment Gateway callback
- Access website using public IP instead of localhost

## Known Issues

- unoptimize and unorganized code , such as try catch, improper error handling
- invalid sql doesn't throw error
- doesn't record payment type on database (billplz retain that record, but still)
- MC and C DB probably not synced
- Commission Rate DB probably should be linked to user
- Tailor ez callback to billpliz code, ie, amount, state
- Potential duplicate payment for cart paid=4
- fix broken pipe but doesn't resume payment, proposal: take advantage of billplz token to resume payment

## v0.4.1

- Fixed broken pipe (paid=2) using cookies
- Fixed enroll duplicate detection
- Fixed commission calculation (roundoff to minimum cent)
- Fixed 1 min calculation bug. Commission now fetch paid price
- Added Course Commission Calculation Function
- Draft Afterpay Receipt
- Several PG DB update

## v0.4

- Added Commission Calculation Function
- Switched to BillPlz Payment Gateway
- Implement direct integration with payment method of choice
- Switch into 100 minimum integer cent format

## v0.3.1

- Handle SenangPay Callback (all rounded)
- Centralized Enrollment Function
- Change order DB key datatype from varchar to int
- Minor Bugfix

## v0.3

- Update change for DB version 211026
- Documented Flowchart
- Enroll course function
- Enroll subcourse function
- Dynamic product type function

## v0.2.1

- Update change for DB version 211018
- Detect existing cart item
- Detect enrolled subcourse
- Include DB Dump in repo
- Add order receipt
- Code optimization

## v0.2

- Integrate SenangPay Payment Gateway
- Enroll Subcourse upon success

## v0.1

- Always successful payment gateway emulation
- Get Cart / Course 
- Add / Remove Cart
- Checkout