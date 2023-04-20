<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    @font-face {
        font-family: "Heebo";
        src: url(../../assets/fonts/Heebo/static/Heebo-Bold.ttf);
        font-weight: 700;
    }

    @font-face {
        font-family: "Heebo";
        src: url(../../assets/fonts/Heebo/static/Heebo-Regular.ttf);
        font-weight: 400;
    }

    * {
        font-family: "Heebo";
        margin: 0;
    }

    .markea-browser-link p {
        font-weight: 400;
        font-size: 13px;
        color: #73767a;
        text-decoration: underline;
    }

    .email-banner,
    .email-template-wrapper {
        padding: 70px 20px;
        border-radius: 5px;
        margin-top: 30px;
    }

    .email-banner h4 {
        color: #fff;
        font-weight: 700;
        font-size: 40px;
        padding-bottom: 10px;
    }

    .email-banner p {
        color: #fff;
        font-weight: 400;
        font-size: 20px;
    }

    .email-template-wrapper h5 {
        font-weight: 700;
        font-size: 20px;
        color: #000;
    }

    .email-template-wrapper p {
        font-weight: 400;
        font-size: 20px;
        color: #3B3B3B;
    }

    .template-footer {
        font-weight: 400;
        font-size: 16px;
        color: #73767a;
    }

    .condition-pages a {
        color: #191919;
        text-decoration: none;
    }

    @media screen and (max-width: 767px) {
        body {
            padding: 10px !important;
        }

        .markea-browser-link p {
            text-align: end;
        }

        .email-template-wrapper a {
            padding: 10px 0px;
            width: 100%;
        }

        .email-template-wrapper {
            padding: 20px !important;

        }
    }
</style>

<body style="background-color: #e1e6ef; padding: 20px 30px;">
    <header style="display: flex; justify-content:space-between;">
        <div class="markea-logo" style="display: flex; align-items:center;">
            <figure style="margin: 0; display: flex; align-items:center;">
                <img src="../../assets/images/email-template/markea-tm-logo.png" alt="">
            </figure>
        </div>
        <div class="markea-browser-link" style="display: flex; align-items:center;">
            <p style="margin: 0;">View this email in your browser</p>
        </div>
    </header>
    <main>
        <div class="email-banner" style="text-align: center; background-color: #003B95;">
            <h4>Thank you for signing up</h4>
            <p>on Markea</p>
        </div>
        <div class="email-template-wrapper" style="background-color: #fff; padding: 30px 50px;">
            <h5>
                Hi {{$user->full_name}}, 👋
            </h5>
            <p style="padding: 20px 0px;">
                <!-- Here is your OTP: {{$user->email_otp_code}} -->
            </p>
            <p>
                <!-- Please do not share this OTP with anyone. -->
            </p>
            <p style="padding-top:10px;">
                Yours sincerly, <br>
                Markea
            </p>
        </div>
    </main>
    <footer class="template-footer" style="background-color:transparent; padding: 50px; text-align: center;">
        <p>
            If you have any questions, feel free message us at support@markea.com. All right reserved. Update email preferences or unsubscribe.
        </p>
        <div class="social-link-wrapper" style="display: flex; align-items:center; justify-content: center; padding: 10px 0px;">
            <a href="" style="padding: 10px;">
                <span>
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16 0C11.6547 0 11.1098 0.018417 9.40324 0.096283C7.70023 0.173958 6.53711 0.444453 5.51939 0.840007C4.46725 1.24883 3.57498 1.79593 2.68542 2.68541C1.79594 3.57497 1.24883 4.46725 0.840007 5.51939C0.444453 6.53711 0.173968 7.70021 0.0962931 9.40322C0.0184271 11.1098 0 11.6547 0 16C0 20.3453 0.0184271 20.8902 0.0962931 22.5968C0.173968 24.2998 0.444453 25.4629 0.840007 26.4806C1.24883 27.5328 1.79594 28.425 2.68542 29.3146C3.57498 30.2041 4.46725 30.7512 5.51939 31.1601C6.53711 31.5555 7.70023 31.826 9.40324 31.9037C11.1098 31.9816 11.6547 32 16 32C20.3453 32 20.8902 31.9816 22.5968 31.9037C24.2998 31.826 25.4629 31.5555 26.4806 31.1601C27.5327 30.7512 28.425 30.2041 29.3146 29.3146C30.2041 28.425 30.7511 27.5328 31.16 26.4806C31.5555 25.4629 31.8261 24.2998 31.9037 22.5968C31.9816 20.8902 32 20.3453 32 16C32 11.6547 31.9816 11.1098 31.9037 9.40322C31.8261 7.70021 31.5555 6.53711 31.16 5.51939C30.7511 4.46725 30.2041 3.57497 29.3146 2.68541C28.425 1.79593 27.5327 1.24883 26.4806 0.840007C25.4629 0.444453 24.2998 0.173958 22.5968 0.096283C20.8902 0.018417 20.3453 0 16 0ZM16 2.88287C20.2722 2.88287 20.7782 2.8992 22.4654 2.97618C24.0254 3.04731 24.8726 3.30796 25.4364 3.52708C26.1832 3.81733 26.7162 4.16405 27.276 4.72397C27.836 5.28383 28.1827 5.81682 28.4729 6.56366C28.692 7.12746 28.9527 7.97464 29.0238 9.53463C29.1008 11.2218 29.1171 11.7278 29.1171 16C29.1171 20.2722 29.1008 20.7782 29.0238 22.4654C28.9527 24.0254 28.692 24.8725 28.4729 25.4363C28.1827 26.1832 27.836 26.7162 27.276 27.276C26.7162 27.836 26.1832 28.1827 25.4364 28.4729C24.8726 28.692 24.0254 28.9527 22.4654 29.0238C20.7785 29.1008 20.2725 29.1171 16 29.1171C11.7275 29.1171 11.2216 29.1008 9.53463 29.0238C7.97464 28.9527 7.12746 28.692 6.56366 28.4729C5.81682 28.1827 5.28382 27.836 4.72396 27.276C4.1641 26.7162 3.81733 26.1832 3.52708 25.4363C3.30796 24.8725 3.04731 24.0254 2.97618 22.4654C2.8992 20.7782 2.88287 20.2722 2.88287 16C2.88287 11.7278 2.8992 11.2218 2.97618 9.53463C3.04731 7.97464 3.30796 7.12746 3.52708 6.56366C3.81733 5.81682 4.16404 5.28383 4.72396 4.72397C5.28382 4.16405 5.81682 3.81733 6.56366 3.52708C7.12746 3.30796 7.97464 3.04731 9.53463 2.97618C11.2218 2.8992 11.7278 2.88287 16 2.88287ZM16 7.78379C11.4623 7.78379 7.78379 11.4623 7.78379 16C7.78379 20.5377 11.4623 24.2162 16 24.2162C20.5377 24.2162 24.2162 20.5377 24.2162 16C24.2162 11.4623 20.5377 7.78379 16 7.78379ZM16 21.3333C13.0545 21.3333 10.6667 18.9455 10.6667 16C10.6667 13.0545 13.0545 10.6667 16 10.6667C18.9455 10.6667 21.3333 13.0545 21.3333 16C21.3333 18.9455 18.9455 21.3333 16 21.3333ZM26.4609 7.45918C26.4609 8.51958 25.6012 9.37915 24.5408 9.37915C23.4805 9.37915 22.6208 8.51958 22.6208 7.45918C22.6208 6.39878 23.4805 5.53914 24.5408 5.53914C25.6012 5.53914 26.4609 6.39878 26.4609 7.45918Z" fill="#191919" />
                    </svg>
                </span>
            </a>
            <a href="" style="padding: 10px;">
                <span>
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17.0922 32H1.76615C0.790448 32 0 31.2091 0 30.2337V1.76614C0 0.79057 0.790572 0 1.76615 0H30.234C31.2093 0 32 0.79057 32 1.76614V30.2337C32 31.2092 31.2092 32 30.234 32H22.0795V19.6078H26.239L26.8618 14.7784H22.0795V11.6951C22.0795 10.2969 22.4678 9.344 24.4729 9.344L27.0302 9.34289V5.0234C26.5879 4.96454 25.0699 4.83305 23.3037 4.83305C19.6166 4.83305 17.0922 7.08368 17.0922 11.2168V14.7784H12.9221V19.6078H17.0922V32Z" fill="#191919" />
                    </svg>
                </span>
            </a>
            <a href="" style="padding: 10px;">
                <span>
                    <svg width="32" height="30" viewBox="0 0 32 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M32 29.0909H24.9276V18.8643C24.9276 16.1875 23.8213 14.3601 21.3885 14.3601C19.5278 14.3601 18.4929 15.5933 18.0113 16.7817C17.8307 17.2083 17.8589 17.8025 17.8589 18.3967V29.0909H10.8523C10.8523 29.0909 10.9426 10.9755 10.8523 9.32877H17.8589V12.4303C18.2728 11.0742 20.5117 9.13876 24.0847 9.13876C28.5174 9.13876 32 11.9814 32 18.1024V29.0909ZM3.76669 6.85687H3.72155C1.46379 6.85687 0 5.34615 0 3.43122C0 1.47903 1.50705 0 3.80997 0C6.111 0 7.52587 1.47533 7.57102 3.42565C7.57102 5.34058 6.111 6.85687 3.76669 6.85687ZM0.807129 9.32877H7.04421V29.0909H0.807129V9.32877Z" fill="#191919" />
                    </svg>
                </span>
            </a>
            <a href="" style="padding: 10px;">
                <span>
                    <svg width="32" height="27" viewBox="0 0 32 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M32 3.15686C30.8242 3.69231 29.5583 4.05442 28.2303 4.21621C29.5864 3.38414 30.627 2.06477 31.1172 0.493083C29.8475 1.26352 28.4445 1.824 26.9456 2.12447C25.751 0.816658 24.0437 0 22.1541 0C18.531 0 15.5915 3.01432 15.5915 6.73167C15.5915 7.25942 15.6478 7.77176 15.7605 8.26484C10.3042 7.98363 5.46763 5.30637 2.22762 1.22884C1.66226 2.22655 1.33919 3.38414 1.33919 4.61683C1.33919 6.95125 2.4981 9.01216 4.25991 10.2198C3.18554 10.1871 2.17127 9.88083 1.28473 9.38004V9.46286C1.28473 12.7256 3.54804 15.4472 6.55326 16.0636C6.00293 16.2215 5.42255 16.3005 4.82338 16.3005C4.40077 16.3005 3.98755 16.26 3.58748 16.181C4.42331 18.8545 6.84627 20.8017 9.72001 20.8537C7.47361 22.6604 4.64119 23.7371 1.56647 23.7371C1.0368 23.7371 0.512766 23.7063 0 23.6446C2.90568 25.5515 6.35792 26.6667 10.0637 26.6667C22.141 26.6667 28.7431 16.4103 28.7431 7.51366C28.7431 7.2209 28.7374 6.92813 28.7262 6.64114C30.009 5.69158 31.1229 4.50705 32 3.15686Z" fill="#191919" />
                    </svg>
                </span>
            </a>
        </div>

        <div class="condition-pages">
            <a href="">Mailus</a> | <a href="">Terms of use</a> | <a href="">Privacy Policy</a>
        </div>
    </footer>


    <!-- <input type="date" placeholder="MY PLACEHOLDER" onchange="this.className=(this.value!=''?'has-value':'')"> -->
</body>

</html>