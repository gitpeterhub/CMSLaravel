<?php

namespace App\Http\Controllers\Frontend\Visitors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\AboutMeRepository;
//use App\Repositories\ContactRepository;
use App\Repositories\EducationRepository;
use App\Repositories\ExperienceRepository;
use App\Repositories\ExpertiseRepository;
use App\Repositories\SkillRepository;

class PortfolioPageController extends Controller
{

	private $aboutMeRepo;
	private $educationRepo;
	private $experienceRepo;
	private $expertiseRepo;
	private $skillRepo;

	function __construct (AboutMeRepository $aboutMeRepo,
						EducationRepository $educationRepo,
						ExperienceRepository $experienceRepo, 
						ExpertiseRepository $expertiseRepo, 
						SkillRepository $skillRepo)
	{

		$this->aboutMeRepo = $aboutMeRepo;
		$this->educationRepo = $educationRepo;
		$this->experienceRepo  = $experienceRepo;
		$this->expertiseRepo = $expertiseRepo;
		$this->skillRepo = $skillRepo;

	}

	public function index(){

		$aboutMe = $this->aboutMeRepo->all();
		$educations = $this->educationRepo->all();
		$experiences = $this->experienceRepo->all();
		$expertises = $this->expertiseRepo->all();
		$skills = $this->skillRepo->all();


		return view('frontend.portfolio.index',compact("aboutMe","educations","experiences","expertises","skills"));
	}
}
