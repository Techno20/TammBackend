@extends('site.layout.main')

@section('css')
    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('assets/site/css/add-service-style-rtl.css') }}" />
    @else
        <link rel="stylesheet" href="{{ asset('assets/site/css/add-service-style.css') }}" />
    @endif
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            if ($('select.nice-select-me').length != 0) {
                $('select.nice-select-me').niceSelect();
            }

            if ($('.tags-input').length != 0) {
                $('.tags-input').val();
            }
        })
    </script>
@endsection

@section('content')
    <div class="body-content">
        <section class="add-new-service">
            <header class="page-header">
                <div class="container">
                    <div class="d-flex align-items-center">
                        <h1>Manage Orders</h1>
                        <div class="page-action-btns">
                            <a href="" class="btn btn-tamm">Save</a>
                            <a href="" class="btn btn-outline-secondary">Save & Review</a>
                        </div>
                    </div>
                </div>
            </header>
            <div class="form-paginator">
                <div class="container">
                    <div class="paginator-holder">
                        <ul class="list-unstyled mb-0 nav justify-content-center">
                            <li><a href="" class="nav-link active"><span>1</span> Overview</a></li>
                            <li><a href="" class="nav-link active"><span>2</span> Pricing</a></li>
                            <li><a href="" class="nav-link"><span>3</span> Service Description</a></li>
                            <li><a href="" class="nav-link"><span>4</span> Requirements</a></li>
                            <li><a href="" class="nav-link"><span>5</span> Gallery</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-9">
                        <div class="add-service-content">
                            <div class="form-group add-title">
                                <h3>Pricing & Scope</h3>
                            </div>
                            <div class="add-service-pricing-sec">

                                <div class="service-packages-sec pricing-group mb-4">
                                    <p>Packages</p>
                                    <div class=" packages-table">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr class="bg-78">
                                                <th>Package</th>
                                                <th><strong>Basic</strong></th>
                                                <th><strong>Standerd</strong></th>
                                                <th><strong>Premiun</strong></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr class="bg-white">
                                                <td rowspan="3" style="width: 180px;">Name</td>
                                                <td>Name your package</td>
                                                <td>Name your package</td>
                                                <td>Name your package</td>
                                            </tr>
                                            <tr class="bg-white">
                                                <td>Describe the details of your offering</td>
                                                <td>Describe the details of your offering</td>
                                                <td>Describe the details of your offering</td>
                                            </tr>
                                            <tr class="bg-white">
                                                <td>
                                                    <select id="time-1" class="form-control nice-select-me">
                                                        <option selected disabled>Choose one ..</option>
                                                        <option>Translation & Writing</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select id="time-2" class="form-control nice-select-me">
                                                        <option selected disabled>Choose one ..</option>
                                                        <option>Translation & Writing</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select id="time-3" class="form-control nice-select-me">
                                                        <option selected disabled>Choose one ..</option>
                                                        <option>Translation & Writing</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr class="bg-light">
                                                <td>Source File</td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                                        <label class="custom-control-label" for="customSwitch1"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="customSwitch12">
                                                        <label class="custom-control-label" for="customSwitch12"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="customSwitch13">
                                                        <label class="custom-control-label" for="customSwitch13"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="bg-white">
                                                <td>Logo Transparency</td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="customSwitch2">
                                                        <label class="custom-control-label" for="customSwitch2"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="customSwitch22">
                                                        <label class="custom-control-label" for="customSwitch22"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="customSwitch23">
                                                        <label class="custom-control-label" for="customSwitch23"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="bg-light">
                                                <td>High Resolution</td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="customSwitch3">
                                                        <label class="custom-control-label" for="customSwitch3"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="customSwitch32">
                                                        <label class="custom-control-label" for="customSwitch32"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="customSwitch33">
                                                        <label class="custom-control-label" for="customSwitch33"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="bg-white">
                                                <td>Social Media Kit</td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="customSwitch4">
                                                        <label class="custom-control-label" for="customSwitch4"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="customSwitch42">
                                                        <label class="custom-control-label" for="customSwitch42"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="customSwitch43">
                                                        <label class="custom-control-label" for="customSwitch43"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="bg-light">
                                                <td>Vector File</td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="customSwitch5">
                                                        <label class="custom-control-label" for="customSwitch5"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="customSwitch52">
                                                        <label class="custom-control-label" for="customSwitch52"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="customSwitch53">
                                                        <label class="custom-control-label" for="customSwitch53"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="bg-white">
                                                <td>Revisions</td>
                                                <td>
                                                    <select id="time-1" class="form-control nice-select-me">
                                                        <option selected disabled>Choose one ..</option>
                                                        <option>Translation & Writing</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select id="time-2" class="form-control nice-select-me">
                                                        <option selected disabled>Choose one ..</option>
                                                        <option>Translation & Writing</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select id="time-3" class="form-control nice-select-me">
                                                        <option selected disabled>Choose one ..</option>
                                                        <option>Translation & Writing</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr class="bg-light">
                                                <td>Price</td>
                                                <td>
                                                    <select id="time-1" class="form-control nice-select-me">
                                                        <option selected disabled>Choose one ..</option>
                                                        <option>Translation & Writing</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select id="time-2" class="form-control nice-select-me">
                                                        <option selected disabled>Choose one ..</option>
                                                        <option>Translation & Writing</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select id="time-3" class="form-control nice-select-me">
                                                        <option selected disabled>Choose one ..</option>
                                                        <option>Translation & Writing</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="extra-service-sec pricing-group mb-4">
                                    <p>Extra Service</p>
                                    <div class="big-checkbox">
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input type="checkbox" class="custom-control-input" id="customCheck9">
                                            <label class="custom-control-label" for="customCheck9">
                                                <h4>Content Upload</h4>
                                                Seller will upload provided content to pages.
                                            </label>
                                        </div>
                                        <div class="table-wrapper">
                                            <table class="table table-borderless">
                                                <tbody>
                                                <tr>
                                                    <td style="width: 200px;">
                                                        Basic
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <span>I'll deliver in only</span>
                                                            <select id="time-3" class="form-control nice-select-me">
                                                                <option selected disabled>1 Day</option>
                                                                <option>1 Day</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <span>for an extra</span>
                                                            <select id="time-3" class="form-control nice-select-me">
                                                                <option selected disabled>1 Day</option>
                                                                <option>Transla</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 200px;">
                                                        Standard
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <span>I'll deliver in only</span>
                                                            <select id="time-3" class="form-control nice-select-me">
                                                                <option selected disabled>1 Day</option>
                                                                <option>1 Day</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <span>for an extra</span>
                                                            <select id="time-3" class="form-control nice-select-me">
                                                                <option selected disabled>1 Day</option>
                                                                <option>Transla</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 200px;">
                                                        Premium
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <span>I'll deliver in only</span>
                                                            <select id="time-3" class="form-control nice-select-me">
                                                                <option selected disabled>1 Day</option>
                                                                <option>1 Day</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <span>for an extra</span>
                                                            <select id="time-3" class="form-control nice-select-me">
                                                                <option selected disabled>1 Day</option>
                                                                <option>Transla</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="pricing-group">
                                    <div class="custom-control custom-checkbox big-check-box1">
                                        <input type="checkbox" class="custom-control-input" id="customCheck9">
                                        <label class="custom-control-label" for="customCheck1">
                                            <h4>Premium Quality Image</h4>
                                            Seller will upload provided content to pages/blog on.
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group pricing-group">
                                    <div class="custom-control custom-checkbox big-check-box1">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">
                                            <h4>E-Commerce Functionality</h4>
                                            Seller will upload provided content to pages/blog on your ..
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="add-service-footer d-flex align-items-center justify-content-between">
                                <a href="" class="btn btn-light">Previous</a>
                                <a href="" class="btn btn-tamm">Next</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
