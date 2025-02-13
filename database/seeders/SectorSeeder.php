<?php

namespace Database\Seeders;

use App\Models\Sector;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sectors = [
            /* 'Agriculture',
            'Automotive',
            'Banking',
            'Construction',
            'Education',
            'Energy',
            'Entertainment',
            'Fashion',
            'Finance',
            'Food',
            'Health',
            'Hospitality',
            'Insurance',
            'Manufacturing',
            'Media',
            'Mining',
            'Pharmaceutical',
            'Real Estate',
            'Retail',
            'Technology',
            'Telecommunications',
            'Transportation',
            'Travel',
            'Utilities', */
            [
                'name' => 'Agriculture',
                'description' => 'Agriculture is the practice of cultivating plants and livestock. Agriculture was the key development in the rise of sedentary human civilization, whereby farming of domesticated species created food surpluses that enabled people to live in cities. The history of agriculture began thousands of years ago. After gathering wild grains beginning at least 105,000 years ago, nascent farmers began to plant them around 11,500 years ago. Pigs, sheep, and cattle were domesticated over 10,000 years ago. Plants were independently cultivated in at least 11 regions of the world. Industrial agriculture based on large-scale monoculture in the twentieth century came to dominate agricultural output, though about 2 billion people still depended on subsistence agriculture.',
            ],
            [
                'name' => 'Automotive',
                'description' => 'The automotive industry comprises a wide range of companies and organizations involved in the design, development, manufacturing, marketing, and selling of motor vehicles. It is one of the world\'s largest economic sectors by revenue. The automotive industry does not include industries dedicated to the maintenance of automobiles following delivery to the end-user, such as automobile repair shops and motor fuel filling stations.',
            ],
            [
                'name' => 'Banking',
                'description' => 'A bank is a financial institution that accepts deposits from the public and creates a demand deposit while simultaneously making loans. Lending activities can be directly performed by the bank or indirectly through capital markets.',
            ],
            [
                'name' => 'Construction',
                'description' => 'Construction is a general term meaning the art and science to form objects, systems, or organizations, and comes from Latin constructio (from com- "together" and struere "to pile up") and Old French construction. To construct is the verb: the act of building, and the noun is construction: how something is built, the nature of its structure.',
            ],
            [
                'name' => 'Education',
                'description' => 'Education is the process of facilitating learning, or the acquisition of knowledge, skills, values, morals, beliefs, habits, and personal development. Educational methods include teaching, training, storytelling, discussion, and directed research. Education frequently takes place under the guidance of educators, however, learners can also educate themselves. Education can take place in formal or informal settings and any experience that has a formative effect on the way one thinks, feels, or acts may be considered educational.',
            ],
            [
                'name' => 'Energy',
                'description' => 'In physics, energy is the quantitative property that must be transferred to an object in order to perform work on, or to heat, the object. Energy is a conserved quantity; the law of conservation of energy states that energy can be converted in form, but not created or destroyed. The SI unit of energy is the joule, which is the energy transferred to an object by the work of moving it a distance of 1 metre against a force of 1 newton.',
            ],
            [
                'name' => 'Entertainment',
                'description' => 'Entertainment is a form of activity that holds the attention and interest of an audience or gives pleasure and delight. It can be an idea or a task, but is more likely to be one of the activities or events that have developed over thousands of years specifically for the purpose of keeping an audience\'s attention.',
            ],
            [
                'name' => 'Fashion',
                'description' => 'Fashion is a popular aesthetic expression at a particular period and place and in a specific context, especially in clothing, footwear, lifestyle, accessories, makeup, hairstyle, and body proportions.',
            ],
            [
                'name' => 'Finance',
                'description' => 'Finance is a term for matters regarding the management, creation, and study of money and investments. Specifically, it deals with the questions of how and why an individual, company or government acquires the money needed – called capital in the company context – and how they spend or invest that money.',
            ],
            [
                'name' => 'Food',
                'description' => 'Food is any substance consumed to provide nutritional support for an organism. Food is usually of plant, animal, or fungal origin, and contains essential nutrients, such as carbohydrates, fats, proteins, vitamins, or minerals. The substance is ingested by an organism and assimilated by the organism\'s cells to provide energy, maintain life, or stimulate growth.',
            ],
            [
                'name' => 'Health',
                'description' => 'Health, according to the World Health Organization, is "a state of complete physical, mental and social well-being and not merely the absence of disease and infirmity."',
            ],
            [
                'name' => 'Hospitality',
                'description' => 'Hospitality refers to the relationship between a guest and a host, wherein the host receives the guest with goodwill, including the reception and entertainment of guests, visitors, or strangers.',
            ],
            [
                'name' => 'Insurance',
                'description' => 'Insurance is a means of protection from financial loss. It is a form of risk management, primarily used to hedge against the risk of a contingent or uncertain loss.',
            ],
            [
                'name' => 'Manufacturing',
                'description' => 'Manufacturing is the production of goods through the use of labor, machines, tools, and chemical or biological processing or formulation. It is the essence of secondary sector of the economy.',
            ],
            [
                'name' => 'Media',
                'description' => 'Media are the communication outlets or tools used to store and deliver information or data. The term refers to components of the mass media communications industry, such as print media, publishing, the news media, photography, cinema, broadcasting (radio and television), digital media, and advertising.',
            ],
        ];

        foreach ($sectors as $sector) {
            Sector::create($sector);
        }
    }
}
