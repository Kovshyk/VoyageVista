<div class="info-bar">
    <div class="container">
        <ul class="info-bar__list">
            <?php if(!empty($configs['whatsapp'][0])) {
                ?>
                <li class="info-bar__item">
                    <svg width="25" height="25" viewBox="0 0 256 258" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_7_45)">
                            <path d="M5.46301 127.456C5.45701 149.133 11.121 170.299 21.891 188.955L4.43301 252.697L69.665 235.593C87.7073 245.415 107.922 250.562 128.465 250.563H128.519C196.334 250.563 251.537 195.38 251.566 127.553C251.579 94.686 238.791 63.78 215.557 40.528C192.327 17.278 161.432 4.46703 128.514 4.45203C60.691 4.45203 5.49201 59.632 5.46401 127.456" fill="url(#paint0_linear_7_45)"/>
                            <path d="M1.07 127.416C1.063 149.873 6.93 171.796 18.084 191.12L0 257.147L67.571 239.43C86.189 249.581 107.151 254.933 128.481 254.941H128.536C198.784 254.941 255.97 197.773 256 127.518C256.012 93.47 242.764 61.453 218.7 37.368C194.633 13.286 162.633 0.014 128.536 0C58.276 0 1.098 57.16 1.07 127.416ZM41.31 187.792L38.787 183.787C28.181 166.923 22.583 147.435 22.591 127.424C22.614 69.029 70.138 21.52 128.576 21.52C156.876 21.532 183.472 32.564 203.476 52.58C223.479 72.598 234.486 99.208 234.479 127.51C234.453 185.905 186.928 233.42 128.536 233.42H128.494C109.481 233.41 90.834 228.304 74.572 218.655L70.702 216.36L30.604 226.873L41.31 187.791V187.792Z" fill="url(#paint1_linear_7_45)"/>
                            <path d="M96.678 74.148C94.292 68.845 91.781 68.738 89.512 68.645C87.654 68.565 85.53 68.571 83.408 68.571C81.284 68.571 77.833 69.37 74.916 72.555C71.996 75.743 63.768 83.447 63.768 99.116C63.768 114.786 75.181 129.929 76.772 132.056C78.365 134.179 98.805 167.363 131.177 180.129C158.081 190.738 163.556 188.628 169.395 188.096C175.235 187.566 188.239 180.394 190.892 172.957C193.547 165.521 193.547 159.147 192.751 157.815C191.955 156.488 189.831 155.691 186.646 154.099C183.46 152.506 167.802 144.801 164.883 143.738C161.963 142.676 159.84 142.146 157.716 145.335C155.592 148.519 149.493 155.691 147.634 157.815C145.777 159.944 143.918 160.209 140.734 158.616C137.547 157.018 127.29 153.659 115.121 142.81C105.653 134.368 99.261 123.943 97.403 120.754C95.545 117.57 97.204 115.844 98.801 114.257C100.232 112.83 101.987 110.538 103.581 108.679C105.169 106.819 105.699 105.492 106.761 103.368C107.824 101.242 107.292 99.382 106.497 97.789C105.699 96.196 99.51 80.445 96.678 74.148Z" fill="white"/>
                        </g>
                        <defs>
                            <linearGradient id="paint0_linear_7_45" x1="12361.1" y1="24829" x2="12361.1" y2="4.45203" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#1FAF38"/>
                                <stop offset="1" stop-color="#60D669"/>
                            </linearGradient>
                            <linearGradient id="paint1_linear_7_45" x1="12800" y1="25714.7" x2="12800" y2="0" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#F9F9F9"/>
                                <stop offset="1" stop-color="white"/>
                            </linearGradient>
                            <clipPath id="clip0_7_45">
                                <rect width="256" height="258" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                   <a href="tel:<?= $this->preparePhoneNumber($configs['whatsapp'][0]) ?>" onclick="sendGoogleTel();" class="info-bar__link"><?= $configs['viber'][0] ?></a>
                </li>
            <?php } ?>
            <?php if(!empty($configs['viber'][0])) {
                ?>
            <li class="info-bar__item">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                     width="25" height="25"
                     viewBox="0 0 48 48"
                     style="enable-background:new 0 0 48 48;; fill:#000000;"><path style="fill: transparent;" d="M24,5C21.361,5,13.33,5,8.89,9.054C6.246,11.688,5,15.494,5,21v3c0,5.506,1.246,9.312,3.921,11.976  c1.332,1.215,3.148,2.186,5.368,2.857L15,39.047v5.328C15,45,15.181,45,15.241,45c0.123,0,0.32-0.039,0.694-0.371  c0.09-0.089,0.75-0.803,3.96-4.399l0.324-0.363l0.485,0.031C21.779,39.965,22.888,40,24,40c2.639,0,10.67,0,15.11-4.055  C41.753,33.311,43,29.505,43,24v-3c0-5.506-1.246-9.312-3.921-11.976C34.67,5,26.639,5,24,5z"></path><path style="fill:#7E57C2;" d="M33.451,28.854c-1.111-0.936-1.624-1.219-3.158-2.14C29.654,26.331,28.68,26,28.169,26  c-0.349,0-0.767,0.267-1.023,0.523C26.49,27.179,26.275,28,25.125,28c-1.125,0-3.09-1.145-4.5-2.625C19.145,23.965,18,22,18,20.875  c0-1.15,0.806-1.38,1.462-2.037C19.718,18.583,20,18.165,20,17.816c0-0.511-0.331-1.47-0.714-2.109  c-0.921-1.535-1.203-2.048-2.14-3.158c-0.317-0.376-0.678-0.548-1.056-0.549c-0.639-0.001-1.478,0.316-2.046,0.739  c-0.854,0.637-1.747,1.504-1.986,2.584c-0.032,0.147-0.051,0.295-0.057,0.443c-0.046,1.125,0.396,2.267,0.873,3.234  c1.123,2.279,2.609,4.485,4.226,6.455c0.517,0.63,1.08,1.216,1.663,1.782c0.566,0.582,1.152,1.145,1.782,1.663  c1.97,1.617,4.176,3.103,6.455,4.226c0.958,0.472,2.086,0.906,3.2,0.874c0.159-0.005,0.318-0.023,0.477-0.058  c1.08-0.238,1.947-1.132,2.584-1.986c0.423-0.568,0.74-1.406,0.739-2.046C33.999,29.532,33.827,29.171,33.451,28.854z"></path><path style="fill:#7E57C2;" d="M34,24c-0.552,0-1-0.448-1-1v-1c0-4.962-4.038-9-9-9c-0.552,0-1-0.448-1-1s0.448-1,1-1  c6.065,0,11,4.935,11,11v1C35,23.552,34.552,24,34,24z"></path><path style="fill:#7E57C2;" d="M27.858,22c-0.444,0-0.85-0.298-0.967-0.748c-0.274-1.051-1.094-1.872-2.141-2.142  c-0.535-0.139-0.856-0.684-0.718-1.219c0.138-0.534,0.682-0.855,1.219-0.718c1.748,0.453,3.118,1.822,3.575,3.574  c0.139,0.535-0.181,1.08-0.715,1.22C28.026,21.989,27.941,22,27.858,22z"></path><path style="fill:#7E57C2;" d="M31,23c-0.552,0-1-0.448-1-1c0-3.188-2.494-5.818-5.678-5.986c-0.552-0.029-0.975-0.5-0.946-1.051  c0.029-0.552,0.508-0.976,1.051-0.946C28.674,14.241,32,17.748,32,22C32,22.552,31.552,23,31,23z"></path><path style="fill:#7E57C2;" d="M24,4C19.5,4,12.488,4.414,8.216,8.316C5.196,11.323,4,15.541,4,21c0,0.452-0.002,0.956,0.002,1.5  C3.998,23.043,4,23.547,4,23.999c0,5.459,1.196,9.677,4.216,12.684c1.626,1.485,3.654,2.462,5.784,3.106v4.586  C14,45.971,15.049,46,15.241,46h0.009c0.494-0.002,0.921-0.244,1.349-0.624c0.161-0.143,2.02-2.215,4.042-4.481  C21.845,40.972,22.989,41,23.999,41c0,0,0,0,0,0s0,0,0,0c4.5,0,11.511-0.415,15.784-4.317c3.019-3.006,4.216-7.225,4.216-12.684  c0-0.452,0.002-0.956-0.002-1.5c0.004-0.544,0.002-1.047,0.002-1.5c0-5.459-1.196-9.677-4.216-12.684C35.511,4.414,28.5,4,24,4z   M41,23.651l0,0.348c0,4.906-1.045,8.249-3.286,10.512C33.832,38,26.437,38,23.999,38c-0.742,0-1.946-0.001-3.367-0.1  C20.237,38.344,16,43.083,16,43.083V37.22c-2.104-0.505-4.183-1.333-5.714-2.708C8.045,32.248,7,28.905,7,23.999l0-0.348  c0-0.351-0.001-0.73,0.002-1.173C6.999,22.078,6.999,21.7,7,21.348L7,21c0-4.906,1.045-8.249,3.286-10.512  C14.167,6.999,21.563,6.999,24,6.999c2.437,0,9.832,0,13.713,3.489c2.242,2.263,3.286,5.606,3.286,10.512l0,0.348  c0,0.351,0.001,0.73-0.002,1.173C41,22.922,41,23.3,41,23.651z"></path></svg>
                <a href="tel:<?= $this->preparePhoneNumber($configs['viber'][0]) ?>" onclick="sendGoogleTel();" class="info-bar__link"><?= $configs['viber'][0] ?></a>
            </li>
            <?php } ?>
            <li class="info-bar__item">
                <svg version="1.1"  x="0px" y="0px" width="20" height="20" viewBox="0 0 16.877 16.877" style="enable-background:new 0 0 16.877 16.877;"xml:space="preserve">
                    <path style="fill:#feab30;" d="M5.301,5.587L1.404,1.688c0.503-0.503,1.005-1.007,1.509-1.511C3.146-0.056,3.522-0.06,3.756,0.17l3.036,3.039
                        c0.232,0.232,0.232,0.614-0.003,0.848L6.124,4.721L5.505,5.34C5.429,5.417,5.36,5.499,5.301,5.587z M8.507,11.938
                        c-0.638-0.549-1.25-1.132-1.844-1.725C6.07,9.616,5.489,9.006,4.939,8.365c-0.45-0.52-0.538-1.273-0.303-1.907L0.636,2.457
                        c-0.931,0.957-0.812,3.33,0.208,5.415c0.438,0.902,1.006,1.716,1.593,2.49c0.586,0.768,1.229,1.494,1.906,2.176
                        c0.679,0.681,1.401,1.327,2.171,1.913c0.774,0.589,1.59,1.153,2.486,1.59c2.088,1.019,4.462,1.131,5.418,0.199l-4.001-4.001
                        C9.783,12.474,9.029,12.387,8.507,11.938z M16.702,13.119l-3.036-3.037c-0.233-0.23-0.615-0.23-0.848,0.003h-0.002l-0.667,0.666
                        l-0.615,0.618c-0.076,0.076-0.159,0.143-0.247,0.205l3.896,3.898c0.504-0.505,1.007-1.007,1.512-1.51
                        C16.93,13.729,16.935,13.352,16.702,13.119z"/>
                </svg>
                <a href="tel:<?= (!empty($configs['phones'][0])) ? $configs['phones'][0] : '' ?>" onclick="sendGoogleTel();" class="info-bar__link"><?= (!empty($configs['phones'][0])) ? $configs['phones'][0] : '' ?></a>
            </li>
        </ul>
    </div>
</div>


