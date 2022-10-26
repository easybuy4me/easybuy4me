@extends('layouts.front')

@section('styles')
    <!-- Style -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="hero_single inner_pages background-image" data-background="url({{ asset('public/assets/img/bb.png') }})">
        <div class="opacity-mask">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h1 class="text-dark">BECOME A VENDOR</h1>
                        <p class="text-dark">get access to a wide range of customers that make daily
                            purchases.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container margin_30_20">
        <div class="row justify-content-center align-items-center add_bottom_15">
            <div class="col-lg-12">
                <div class="box_about">
                    <h3>Who are we?</h3>
                    <p>
                        Easybuy4me is an online errands service operating in Lafia, Nasarawa state. We run almost any kind
                        of
                        errands from doing grocery shopping, buying meal from your favorite restaurant to doing item pick-up
                        and making delivery to offices or your homes
                    </p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center align-items-center add_bottom_15">
            <div class="col-lg-12">
                <div class="box_about">
                    <h3>Benefit of being EasyBuy4Me vendor?</h3>
                    <p>
                        When you become a vendor with us, you get access to a wide range of customers that make daily
                        purchases on our platforms. Also, you get have more sales as we periodically advertise our vendor’s
                        items
                        on our platforms (website, whatsapp and other channels). Ready to make more money and get more
                        exposure?
                    </p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center align-items-center add_bottom_15">
            <div class="col-lg-12">
                <div class="box_about">
                    <h6>Kindly note:</h6>
                    <p>
                        You are expected to pay a one-time enrollment fee of N2500 which will be used to:
                    </p>
                    <p>
                        a. Create an online and physical flier that will be used on our platform and placed in your shop
                    </p>
                    <p>
                        b. Pay for the branding team to take pictures of your items
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container margin_60_20" id="submit">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="text-center add_bottom_15">
                    <h4>Please fill the form below</h4>
                </div>
                <div id="message-register"></div>
                <form method="post" action="" id="register">
                    <h6>Business Data</h6>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="business name" name="name"
                                    id="name" required>
                            </div>
                        </div>
                    </div>
                    <!-- /row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Email Address" name="email"
                                    id="email">
                            </div>
                        </div>
                    </div>
                    <!-- /row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Contact Person Name"
                                    name="contact_person_name" id="contact_person_name">
                            </div>
                        </div>
                    </div>
                    <!-- /row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Address" name="address"
                                    id="address">
                            </div>
                        </div>
                    </div>
                    <!-- /row -->
                    <div class="row add_bottom_15">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Phone number" name="phone_number"
                                    id="phone_number" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Phone number 2" name="phone_number2"
                                    id="phone_number2" required>
                            </div>
                        </div>
                    </div>
                    <!-- /row -->
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Operation Days</label>
                                <select name="operation_days[]" class="form-control wide select" multiple>
                                    <option value="">Operation Days</option>
                                    <option value="monday">Monday</option>
                                    <option value="tuesday">Tuesday</option>
                                    <option value="wednesday">Wednessday</option>
                                    <option value="thursday">Thursday</option>
                                    <option value="friday">Friday</option>
                                    <option value="saturday">Saturday</option>
                                    <option value="sunday">Sunday</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Referral Code" name="referral_code">
                            </div>
                        </div>
                    </div>
                    <!-- /row -->

                    <div class="form-group text-center">
                        <button type="submit" class="btn_1 gradient" id="submit-register">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
    $('.select').select2();
});
</script>

<script>
    $('#submit-register').click(function(e){
        e.preventDefault()

        $.post('/api/login',{}).then(function(data){

        }).catch(function(err){
            console.log(err.response)
        })
    })
</script>
@endsection
