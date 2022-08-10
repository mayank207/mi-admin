@extends('customer.layouts.app')
@section('title','Home')
@section('content')
<section class="px-lg-4 px-xl-5 border-bottom-1">
    <div class="container py-3">
        <div class="row align-items-center">
            <div class="col-12 col-sm-4 col-xl-4 order-2 order-xl-1">
                <ul class="navbar-nav font-mulish-bold">
                    <li class="nav-item">
                        <a class="nav-link font-14 text-navy-blue"
                            href="{{route('home')}}"><img src="{{asset('img/Arrow-left.png')}}"
                            class="img-fluid mr-4" alt=""><u>Go to homepage</u></a>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-xl-4 text-center order-1 order-xl-2 mb-3 mb-xl-0">
                <img src="{{asset('img/logo.png')}}" class="img-fluid" alt="">
            </div>
            <div class="col-12 col-sm-8 col-xl-4 order-3 order-xl-3">
                <ul class="navbar-nav flex-row flex-wrap justify-content-between justify-content-sm-end font-mulish-bold">
                    <li class="nav-item mr-4">
                        <a class="nav-link font-16 text-navy-blue"
                            href="mailto:{{env('CONTACT_EMAIL')}}">Contact Kingdom</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('signup')}}"
                            class="btn text-white bg-navy-blue br-6 font-16 shadow-none px-4 py-2">Join Kingdom</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="px-lg-4 px-xl-5 pt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-black font-weight-bold font-40 font-mulish-bold">
                    <span class="text-navy-blue">Kingdom</span> is a free, unique tool that is helping churches bring
                    <span class="text-navy-blue">VOCATION</span> and <span class="text-navy-blue">FAITH</span> together!
                </h1>
            </div>
        </div>

        <div class="row mt-3 align-items-center">
            <div class="col-12 col-lg-4 text-center">
                <img src="{{asset('img/profile-rounded.png')}}" class="img-fluid rounded-circle" alt="">
            </div>
            <div class="col-12 col-lg-8 mt-4 mt-lg-0">
                <div class="font-lato">
                    <p class="font-18 text-black font-weight-bold mb-0">From</p>
                    <p class="font-18 text-dark-gray">Tim Kopylov</p>
                    <p class="font-18 text-dark-gray mt-4 mb-2">Dear Pastor,</p>
                    <p class="font-18 text-dark-gray">
                        Kingdom is an <span class="text-black font-weight-bold">online directory of Christian-owned
                            businesses </span> that is helping pastors save time
                        and solve a real need in the church. The best part is that there is no cost to the church. It is
                        a resource that brings <span class="text-black font-weight-bold">vocation </span> and <span
                            class="text-black font-weight-bold">faith </span> together, allowing pastors to <span
                            class="text-black font-weight-bold">work smarter, not
                            harder.</span> Not only is Kingdom free to pastors, but it is bringing a new source of
                        revenue into
                        their church.</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center bg-light-gray br-35 px-3 px-md-4 py-5 mt-4 mx-0">
            <div class="col-12 col-lg-8">
                <div class="embed-responsive embed-responsive-16by9 br-10">
                    <iframe src="https://player.vimeo.com/video/730958825" width="{video_width}" height="{video_height}" frameborder="0" title="introducation" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-12 col-lg-4 mt-4 mt-lg-0">
                <h1 class="text-navy-blue font-mulish-bold font-28">“It is vital to bring our faith into the workplace
                    and to support each other’s businesses. This will help us to advance God’s kingdom in our
                    communities. ”</h1>
            </div>

            <div class="col-12 col-lg-9 mt-5">
                <a href="{{route('signup')}}"
                    class="btn btn-block btn-navy-blue-outline rounded-pill font-20 font-mulish font-weight-bold py-3">I’m
                    ready to work with Kingdom! <img src="{{asset('img/Arrow-navy-blue.png')}}" class="img-fluid ml-2"
                        alt=""></a>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <p class="font-18 text-dark-gray">Most pastors have the desire for their members to support the
                    businesses within their church, but if you are like most pastors you lack the time and resources to
                    make that happen. That is where Kingdom comes in.</p>
                <p class="font-18 text-dark-gray">We are constantly creating tools and ways that free up pastors so they
                    can be more effective in leading their congregation. <span class="text-black font-weight-bold">Our
                        aim is to bring real value to your church and to be a blessing to you.</span> To learn more
                    about how we are doing that, watch Pastor Mike Lotzer of Mercy Road interview Tim Kopylov, the
                    founder of Kingdom.</p>
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-12 text-center">
                <h1 class="text-primary-blue font-lato font-weight-bold font-28"><u>Full Interview</u></h1>
            </div>
            <div class="col-12 col-lg-8 mt-4">
                <div class="embed-responsive embed-responsive-16by9 br-10">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>

        <div class="row justify-content-center px-3 px-md-4 mt-3">
            <div class="col-12 col-lg-8">
                <p class="font-18 text-dark-gray font-weight-bold font-lato font-italic">Below you can jump to different
                    sections of the interview</p>
                <ul class="pl-4">
                    <li>
                        <a href="#" class="text-primary-blue font-18 font-lato"><u>Introduction - Who is Mike and
                                Tim?</u></a> <span class="text-dark-gray font-lato">- 2:04 minutes</span>
                    </li>
                    <li class="mt-2">
                        <a href="#" class="text-primary-blue font-18 font-lato"><u>What is Kingdom?</u></a> <span
                            class="text-dark-gray font-lato">- 1:01 minutes</span>
                    </li>
                    <li class="mt-2">
                        <a href="#" class="text-primary-blue font-18 font-lato"><u>How Kingdom got started</u></a> <span
                            class="text-dark-gray font-lato">- 2:42 minutes</span>
                    </li>
                    <li class="mt-2">
                        <a href="#" class="text-primary-blue font-18 font-lato"><u>Bringing Value to your Church</u></a>
                        <span class="text-dark-gray font-lato">- 3:31 minutes</span>
                    </li>
                    <li class="mt-2">
                        <a href="#" class="text-primary-blue font-18 font-lato"><u>How do you vet Christian-owned
                                businesses?</u></a> <span class="text-dark-gray font-lato">- 2:34 minutes</span>
                    </li>
                    <li class="mt-2">
                        <a href="#" class="text-primary-blue font-18 font-lato"><u>Will we get quality Christian
                                work?</u></a> <span class="text-dark-gray font-lato">- 2:16 minutes</span>
                    </li>
                    <li class="mt-2">
                        <a href="#" class="text-primary-blue font-18 font-lato"><u>How to handle Christians who are
                                expecting discounts</u></a> <span class="text-dark-gray font-lato">- 2:38 minutes</span>
                    </li>
                    <li class="mt-2">
                        <a href="#" class="text-primary-blue font-18 font-lato"><u>A solution for busy pastors</u></a>
                        <span class="text-dark-gray font-lato">- 0:49 minutes</span>
                    </li>
                    <li class="mt-2">
                        <a href="#" class="text-primary-blue font-18 font-lato"><u>How can we trust Kingdom?</u></a>
                        <span class="text-dark-gray font-lato">- 1:09 minutes</span>
                    </li>
                    <li class="mt-2">
                        <a href="#" class="text-primary-blue font-18 font-lato"><u>Mike Lotzer’s conclusion on
                                Kingdom</u></a> <span class="text-dark-gray font-lato">- 2:35 minutes</span>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-lg-4 mt-4 mt-lg-0">
                <h1 class="text-navy-blue font-mulish-bold font-28">“Not only is there no charge to your church to use
                    Kingdom, but Kingdom is tithing back a portion of the membership dues back to your church.”</h1>
            </div>

            <div class="col-12 col-lg-9 mt-5">
                <a href="{{route('church.signup')}}"
                    class="btn btn-block btn-blue-outline rounded-pill font-20 font-mulish font-weight-bold py-3">Click
                    here to bring vocation and faith together in your church. <img src="{{asset('img/Arrow-blue.png')}}"
                        class="img-fluid ml-2" alt=""></a>
            </div>

            <div class="col-12 mt-5">
                <p class="font-18 text-dark-gray">If you have <span class="text-black font-weight-bold">any
                        questions</span> feel free to reach out to Tim Kopylov
                    directly at <a href="mailto:tim@kingdombusinesses.com"
                        class="text-primary-blue"><u>tim@kingdombusinesses.com</u></a> or if you would like to set up a
                    zoom call with Tim please go
                    to <a href="#" class="text-primary-blue"><u>calendly.com/kingdom-businesses</u></a> to set up a time
                    to meet with him.</p>
            </div>
        </div>
    </div>
</section>

<section class="px-lg-4 px-xl-5 py-4 bg-church-banner mt-4">
    <div class="container">
        <div class="row justify-content-center mx-0">
            <div class="col-12 text-center">
                <p class="font-18 text-navy-blue-dark font-lato">We are using a new marketing approach here at Kingdom.
                    Our
                    aim is to keep
                    everyone's dollars circulating in Christian circles for as long as possible. That is why we are not
                    giving
                    our marketing dollars to Google or social media platforms, but rather we are giving it back to your
                    church.
                    Ten percent of our membership fees go back to the churches where members attend. </p>
                 
                <p class="font-18 text-navy-blue-dark font-lato"> This creates a new source of income for churches to do
                    more for God’s
                    kingdom. <span class="font-weight-bold">But this model only works
                        when you work with us.</span> Would you be willing to share Kingdom with your congregation? We
                    have
                    templates for
                    emails, brochures, and fliers that will make sharing Kingdom with your congregation a breeze. Would
                    you
                    prayerfully consider giving Kingdom a try? </p>

                <p class="font-18 text-navy-blue-dark font-lato"> Complete your online church account and let us know
                    that
                    you are ready for
                    the next step. We will share tips
                    and templates that you can use. We are here to serve and help in any way we can. </p>
            </div>

            <div class="col-12 col-lg-6 text-center mt-4">
                <a href="{{route('church.signup')}}" class="btn btn-block btn-yellow rounded-pill font-20 font-mulish font-weight-bold py-3">Click
                    here to register your Church. <img src="{{asset('img/Arrow-white.png')}}" class="img-fluid ml-2"
                        alt=""></a>
            </div>
        </div>
    </div>
</section>
<section class="px-lg-4 px-xl-5 py-5 bg-navy-blue-dark">
    <div class="container">
        <div class="row justify-content-center mx-0">
            <div class="col-12 col-lg-8">
                <p class="font-22 text-white font-weight-bold font-lato">Just to clarify</p>
                <ul class="pl-4">
                    <li class="font-16 text-white font-lato">We are not asking for any money</li>
                    <li class="font-16 text-white font-lato">We are not asking for any microphone time</li>
                    <li class="font-16 text-white font-lato">Kingdom will save you time and energy, freeing up your time
                        to focus on more important tasks.</li>
                </ul>
                <p class="font-16 text-white font-lato mt-4">
                    We are asking for the opportunity to serve your church. Members within your church will be able to
                    search our platform for high-quality, trusted Christian-owned businesses and they can use a filter
                    so that only members from your church show up. This way members can find what they are looking for
                    and have their hard-earned income circulate among your church members.
                </p>
            </div>
            <div class="col-12 col-lg-4 mt-4 mt-lg-0">
                <h1 class="text-sky-blue font-mulish-bold font-28">“Pastors don’t have the time and resources to
                    connect everyone in an effective way that is fair and honors God.” </h1>

                <h1 class="text-sky-blue font-mulish-bold font-28 mt-4">“Kingdom has become a force multiplier for my
                    church.”</h1>
            </div>

            <div class="col-12 border-bottom border-white op-4 my-4"></div>

            <div class="col-12 col-lg-8 text-center mt-2">
                <h1 class="star-gold font-mulish-bold font-28"><u>Help your church to be intentional with supporting the
                        Christian economy.</u></h1>
            </div>
        </div>
    </div>
</section>
@endsection